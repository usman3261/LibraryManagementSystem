@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Incoming Requests</h2>
        <p class="text-muted small">Review student requests to borrow specific titles.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small fw-bold">STUDENT</th>
                            <th class="py-3 text-secondary small fw-bold">REQUESTED BOOK</th>
                            <th class="py-3 text-secondary small fw-bold">DATE SENT</th>
                            <th class="pe-4 py-3 text-secondary small fw-bold text-end">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $request->user->first_name ?? 'N/A' }}</div>
                                </td>
                                <td>{{ $request->book->title ?? 'N/A' }}</td>
                                <td class="small text-muted">{{ $request->created_at->format('d M, h:i A') }}</td>
                                <td class="pe-4 text-end">
                                    <form action="{{ route('approveRequest', ['requestId' => $request->id]) }}" method="POST" onsubmit="return confirm('Issue this book now?');">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm px-3 shadow-sm">Approve & Issue</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-5 text-muted">No pending requests.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection