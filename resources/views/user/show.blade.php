@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Student Management</h2>
            <p class="text-muted small">Overview of registered library members and their access roles.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('addUser') }}" class="btn btn-primary shadow-sm px-4">Register New Student</a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-3">Dashboard</a>
        </div>
    </div>

    {{-- Session Feedback --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small fw-bold">MEMBER ID</th>
                            <th class="py-3 text-secondary small fw-bold">FULL NAME</th>
                            <th class="py-3 text-secondary small fw-bold">EMAIL ADDRESS</th>
                            <th class="py-3 text-secondary small fw-bold">ROLE</th>
                            <th class="pe-4 py-3 text-secondary small fw-bold text-end">MANAGEMENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($userRole as $link)
                            <tr>
                                <td class="ps-4">
                                    <span class="text-muted font-monospace small">#USR-{{ $link->user->id }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $link->user->first_name }} {{ $link->user->last_name }}</div>
                                </td>
                                <td>
                                    <span class="text-secondary">{{ $link->user->email }}</span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill {{ $link->role->name == 'Librarian' ? 'bg-primary-subtle text-primary' : 'bg-info-subtle text-info' }} border px-3">
                                        {{ $link->role->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group shadow-sm">
                                        <a href="{{ route('userEdit', ['id' => $link->user->id]) }}" class="btn btn-sm btn-white border-end">
                                            Update
                                        </a>
                                        <form action="{{ route('userDestroy') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to permanently remove this user account?');">
                                            @csrf
                                            <input type="hidden" name="delete" value="{{ $link->user->id }}">
                                            <button type="submit" class="btn btn-sm btn-white text-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <p class="text-muted mb-0">No registered students found in the system.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection