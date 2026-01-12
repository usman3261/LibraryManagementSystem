@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Welcome, {{ Auth::user()->first_name }}</h2>
        <p class="text-muted small">You are logged in as: 
            <span class="badge bg-secondary">{{ Auth::user()->roles->first()->name }}</span>
        </p>
    </div>

    <div class="row">
        {{-- LIBRARIAN BOXES --}}
        @if(Auth::user()->roles->contains('name', 'Librarian'))
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0 border-top border-primary border-4">
                    <div class="card-body">
                        <h5 class="fw-bold">Librarian Panel</h5>
                        <p class="text-muted small">Manage the library collection and student requests.</p>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="{{ route('bookShow') }}" class="btn btn-outline-primary btn-sm text-start">Manage Books</a>
                            <a href="{{ route('userShow') }}" class="btn btn-outline-primary btn-sm text-start">Manage Students</a>
                            <a href="{{ route('pendingRequests') }}" class="btn btn-outline-danger btn-sm text-start">Review Pending Requests</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- STUDENT BOXES --}}
        @if(Auth::user()->roles->contains('name', 'Student'))
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0 border-top border-success border-4">
                    <div class="card-body">
                        <h5 class="fw-bold text-success">Student Portal</h5>
                        <p class="text-muted small">Browse the catalog and check your borrowed books.</p>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="{{ route('studentBookShow') }}" class="btn btn-outline-success btn-sm text-start">View Library Catalog</a>
                            <a href="{{ route('studentHistory') }}" class="btn btn-outline-success btn-sm text-start">My Reading History</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection