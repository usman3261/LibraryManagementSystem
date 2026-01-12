@extends('layouts.app_plain')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark">LMS</h2>
            <p class="text-muted small uppercase">Student Registration</p>
        </div>

        <div class="card p-4">
            <h5 class="text-center mb-4">Create New Account</h5>
            <form action="{{ route('user-submit') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label small fw-bold">First Name</label>
                        <input type="text" name="fname" class="form-control" required>
                    </div>
                    <div class="col">
                        <label class="form-label small fw-bold">Last Name</label>
                        <input type="text" name="lname" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Set Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                
                <input type="hidden" name="role[]" value="2">

                <button type="submit" class="btn btn-primary w-100 py-2">Register Now</button>
            </form>
        </div>
        <div class="text-center mt-3">
            <small class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login here</a></small>
        </div>
    </div>
</div>
@endsection