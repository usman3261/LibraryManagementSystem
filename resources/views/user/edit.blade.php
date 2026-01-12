@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class="fw-bold text-dark mb-4">Edit Member Profile</h4>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('userUpdate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="userId" value="{{ $user->id }}">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">First Name</label>
                            <input type="text" name="fname" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Last Name</label>
                            <input type="text" name="lname" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="bg-light p-3 rounded mb-4 border">
                        <label class="form-label small fw-bold text-dark">Password Security</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password (optional)">
                        <div class="form-text small">Leave blank to keep the current password.</div>
                    </div>

                    <div class="d-flex gap-2 border-top pt-4">
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Update Account</button>
                        <a href="{{ route('userShow') }}" class="btn btn-light border px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection