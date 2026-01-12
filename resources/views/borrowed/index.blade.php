@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Issued Book Logs</h2>
            <p class="text-muted small">Official record of all book loans and return timestamps.</p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small fw-bold">STUDENT</th>
                            <th class="py-3 text-secondary small fw-bold">BOOK TITLE</th>
                            <th class="py-3 text-secondary small fw-bold">DUE DATE</th>
                            <th class="py-3 text-secondary small fw-bold">STATUS</th>
                            <th class="pe-4 py-3 text-secondary small fw-bold text-end">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowedRecords as $record)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $record->user->first_name }} {{ $record->user->last_name }}</div>
                                <div class="small text-muted">{{ $record->user->email }}</div>
                            </td>
                            <td><div class="text-dark">{{ $record->book->title }}</div></td>
                            <td><span class="small">{{ \Carbon\Carbon::parse($record->due_date)->format('d M, Y') }}</span></td>
                            <td>
                                @if($record->return_date)
                                    <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3">
                                        Returned
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-warning-subtle text-warning border border-warning-subtle px-3">
                                        Active Loan
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                @if(!$record->return_date)
                                <form action="{{ route('returnBook') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="borrowId" value="{{ $record->id }}">
                                    <button type="submit" class="btn btn-sm btn-primary shadow-sm">Mark Returned</button>
                                </form>
                                @else
                                    <span class="text-muted small fw-bold pe-2">Completed</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No transaction logs available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection