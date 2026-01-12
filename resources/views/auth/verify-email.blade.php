@extends('layouts.app_plain')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-4">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">LMS</h2>
                <p class="text-muted small text-uppercase">Library Management System</p>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-4 fw-bold">Account Sign In</h5>
                    
                    @if(session('error'))
                        <div class="alert alert-danger p-2 small text-center border-0 mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com" required autofocus>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">Sign In</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light text-center py-3 border-0 rounded-bottom">
                    <small class="text-muted">Authorized Personnel Only</small>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('addUser') }}" class="text-decoration-none small text-primary fw-bold">New Student? Register here</a>
            </div>
        </div>
    </div>
</div>
@endsection