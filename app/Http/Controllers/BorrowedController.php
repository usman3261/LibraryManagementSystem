<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowed;
use App\Models\UserRole;
use App\Models\User;
use App\Models\BookRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookRequestNotification;
use Illuminate\Support\Facades\Log;

class BorrowedController extends Controller
{
    /**
     * Display a listing of all currently borrowed books for the Librarian.
     */
    public function index()
    {
        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $borrowedRecords = Borrowed::with(['user', 'book'])->get();
        return view('borrowed.index', compact('borrowedRecords'));
    }

    /**
     * Show the form for issuing a book manually to a student.
     */
    public function issueForm($bookId)
    {
        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $book = Book::findOrFail($bookId);
        
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->get(); 
        
        return view('book.issue_form', compact('book', 'students'));
    }
    
    /**
     * Process the manual issuance of a book.
     */
    public function issueBook(Request $req)
    {
        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $borrow = new Borrowed;
        $borrow->userId = $req->studentId;
        $borrow->bookId = $req->bookId;
        $borrow->issued_date = date('Y-m-d');
        $borrow->due_date = date('Y-m-d', strtotime('+7 days')); 
        $borrow->save();

        $book = Book::find($req->bookId);
        if ($book) {
            $book->status = 'borrowed';
            $book->update();
        }

        return redirect()->back()->with('success', 'Book issued successfully');
    }

    /**
     * Process the return of a book.
     */
    public function returnBook(Request $req)
    {
        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $id = $req->borrowId;
        $borrow = Borrowed::find($id);

        if ($borrow) {
            $borrow->return_date = date('Y-m-d');
            $borrow->update();

            $book = Book::find($borrow->bookId);
            if ($book) {
                $book->status = 'available';
                $book->update();
            }
        }

        return redirect()->back()->with('success', 'Book returned successfully');
    }

    /**
     * Show the borrowing history for the currently logged-in student.
     */
    public function studentHistory()
    {
        $userId = Auth::id();
        $myBooks = Borrowed::where('userId', $userId)
                            ->with('book')
                            ->get();
        
        return view('user.my_books', compact('myBooks'));
    }

    /**
     * Logs a student's request for a book and notifies the Admin via Gmail.
     */
    public function logBookRequest($bookId)
    {
        $user = Auth::user();
        $book = Book::find($bookId);

        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        // 1. Save request to database
        $bookRequest = new BookRequest();
        $bookRequest->user_id = $user->id;
        $bookRequest->book_id = $bookId;
        $bookRequest->status = 'pending';
        $bookRequest->save();

        // 2. Prepare Notification Data
        $details = [
            'student_name' => $user->first_name . ' ' . $user->last_name,
            'book_title' => $book->title
        ];

        // 3. Send Gmail Notification to Admin
        try {
            Mail::to('usman5171338@gmail.com')->send(new BookRequestNotification($details));
        } catch (\Exception $e) {
            // Logs error if internet or SMTP fails, but request is still saved
            Log::error("Gmail Notification failed: " . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Request sent! Librarian has been notified via Gmail.');
    }
    
    /**
     * Display all pending book requests for the Librarian.
     */
    public function pendingRequests()
    {
        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $requests = BookRequest::where('status', 'pending')
                                ->with(['user', 'book']) 
                                ->orderBy('created_at', 'asc')
                                ->get();
        
        return view('borrowed.pending', compact('requests'));
    }

    /**
     * Librarian approves a request, converts it to a Borrowed record, and updates book status.
     */
    public function approveRequest(Request $request, $requestId)
    {
        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $bookRequest = BookRequest::findOrFail($requestId);
        
        if ($bookRequest->book->status != 'available') {
             $bookRequest->status = 'denied';
             $bookRequest->save();
             return redirect()->route('pendingRequests')->with('error', 'Book is no longer available. Request denied.');
        }
        
        // Create the Borrowing record
        $borrow = new Borrowed;
        $borrow->userId = $bookRequest->user_id; 
        $borrow->bookId = $bookRequest->book_id;
        $borrow->issued_date = date('Y-m-d');
        $borrow->due_date = date('Y-m-d', strtotime('+7 days')); 
        $borrow->save();

        // Update Book status
        $bookRequest->book->status = 'borrowed';
        $bookRequest->book->save();
        
        // Mark request as fulfilled
        $bookRequest->status = 'fulfilled';
        $bookRequest->save();

        return redirect()->route('pendingRequests')->with('success', 'Request fulfilled and book issued to ' . $bookRequest->user->first_name);
    }
}