@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">My Reading History</h2>
            <p class="text-muted small">Keep track of the books you have borrowed and their return status.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3">
            Back to Dashboard
        </a>
    </div>

    <div class="row">
        @forelse($myBooks as $item)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card h-100 shadow-sm border-0 overflow-hidden">
                    <div class="row g-0 h-100">
                        <div class="col-4 bg-light d-flex align-items-center justify-content-center p-2 border-end">
                            @if($item->book->image)
                                <img src="{{ asset('uploads/books/'.$item->book->image) }}" 
                                     class="img-fluid rounded shadow-sm" 
                                     alt="cover" 
                                     style="max-height: 120px; object-fit: contain;">
                            @else
                                <div class="text-center">
                                    <small class="text-muted">No Image</small>
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-8">
                            <div class="card-body d-flex flex-column h-100">
                                <h6 class="fw-bold text-dark mb-1">{{ $item->book->title }}</h6>
                                <p class="text-muted small mb-2">By {{ $item->book->author }}</p>
                                
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center small mb-1">
                                        <span class="text-secondary">Due Date:</span>
                                        <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($item->due_date)->format('d M, Y') }}</span>
                                    </div>

                                    @if(!$item->return_date)
                                        <div class="p-2 rounded bg-warning-subtle border border-warning-subtle mt-2">
                                            <span class="text-warning fw-bold small">Currently Issued</span>
                                        </div>
                                    @else
                                        <div class="p-2 rounded bg-success-subtle border border-success-subtle mt-2">
                                            <span class="text-success small">
                                                Returned: <strong>{{ \Carbon\Carbon::parse($item->return_date)->format('d M') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 mt-5">
                <div class="card border-0 shadow-sm p-5 text-center">
                    <div class="text-muted mb-3">
                        <i class="bi bi-journal-x" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-secondary">Your borrowing history is empty.</h5>
                    <p class="text-muted mb-4">Explore the catalog to find your next great read.</p>
                    <div>
                        <a href="{{ route('studentBookShow') }}" class="btn btn-primary px-4">Browse Catalog</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection