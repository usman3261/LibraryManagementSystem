@extends('layouts.app_plain')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark">LMS</h2>
            <p class="text-muted small uppercase">Library Management System</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger small text-center">{{ session('error') }}</div>
        @endif

        <div class="card p-4">
            <h5 class="text-center mb-4">Account Login</h5>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Sign In</button>
            </form>
        </div>
        <div class="text-center mt-3">
            <small class="text-muted">Not registered? <a href="{{ route('addUser') }}" class="text-decoration-none">Create Student Account</a></small>
        </div>
    </div>
</div>
@endsection