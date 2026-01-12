<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    public function index()
    {
        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $books = Book::all();
        return view('book.show', compact('books'));
    }

    public function create()
    {

        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        return view('book.add');
    }

    public function store(Request $request)
    {

        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $book = new Book;
        $book->title = $request->title;
        $book->author_name = $request->author;
        $book->status = 'available';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/books/', $filename);
            $book->image = $filename;
        }

        $book->save();
        return redirect()->route('bookShow');
    }

    public function edit(Request $req)
    {

        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $book = Book::find($req->edit);
        return view('book.edit', compact('book'));
    }

    public function update(Request $abc)
    {

        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $book = Book::find($abc->update);
        if ($book) {
            $book->title = $abc->title;
            $book->author_name = $abc->author;
            if ($abc->hasFile('image')) {
                $oldPath = public_path('uploads/books/' . $book->image);
                if (File::exists($oldPath)) { File::delete($oldPath); }
                
                $file = $abc->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/books/', $filename);
                $book->image = $filename;
            }
            $book->update();
        }
        return redirect()->route('bookShow');
    }

    public function destroy(Request $req)
    {

        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $book = Book::find($req->delete);
        if ($book && $book->image) {
            File::delete(public_path('uploads/books/' . $book->image));
        }
        Book::destroy($req->delete);
        return redirect()->route('bookShow');
    }

    public function studentIndex()
    {
        $books = Book::all(); 
        return view('book.student_show', compact('books'));
    }
}