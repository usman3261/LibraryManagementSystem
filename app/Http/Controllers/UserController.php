<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Registration Form
    public function index()
    {
        $role = Role::all(); 
        return view('user.add', compact('role'));
    }

    // Save New User
    public function store(Request $request)
    {
        $user = new User;
        $user->first_name = $request->fname;
        $user->last_name = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $userId = $user->id;
        $userRoleRequest = $request->input('role', []); 

        if (!empty($userRoleRequest)) {
            foreach ($userRoleRequest as $roleId) {
                $userRoles = new UserRole;
                $userRoles->roleId = $roleId;
                $userRoles->userId = $userId;
                $userRoles->save();
            }
        }
        
        return redirect()->route('login-user')->with('success', 'Registration successful.');
    }

    // Login Form
    public function login()
    {
        return view('user.login');
    }

    // Process Login
    public function authLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }

    // Dashboard Hub
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login-user');
        }

        $user = Auth::user();
        // Simplified way to get role names for the dashboard boxes
        $names = $user->roles->pluck('name')->toArray();

        return view('user.dashboard', compact('names'));
    }

    // Student List (Librarian View)
    public function show()
    {

        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $userRole = UserRole::whereHas('role', function ($query) {
            $query->where('name', 'Student');
        })->get();
     
        return view("user.show", compact('userRole'));
    }

    // Edit User
    public function edit($id)
    {

        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = UserRole::where('userId', $id)->pluck('roleId')->toArray();

        return view('user.edit', compact('user', 'roles', 'userRoles'));
    }

    // Update User
    public function update(Request $request)
    {

        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        $user = User::findOrFail($request->userId);
        $user->first_name = $request->fname;
        $user->last_name = $request->lname;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('userShow')->with('success', 'User updated successfully.');
    }

    // Delete User
    public function destroy(Request $req)
    {

        if (!Auth::user()->roles->contains('name', 'Librarian')) {
        return redirect()->route('dashboard');
    }
        User::destroy($req->delete);
        return redirect()->route('userShow');
    }
    
    // Logout
    public function logout() {
        Auth::logout();
        return redirect()->route('login-user');
    }
}