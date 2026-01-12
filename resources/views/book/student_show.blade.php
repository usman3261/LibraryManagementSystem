@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Library Catalog</h2>
            <p class="text-muted small">Search and request books for borrowing.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($books as $book)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="text-center bg-light py-4 border-bottom">
                        @if($book->image)
                            <img src="{{ asset('uploads/books/' . $book->image) }}" class="rounded shadow-sm" style="height: 150px; width: 110px; object-fit: cover;">
                        @else
                            <div class="mx-auto bg-white border rounded shadow-sm d-flex align-items-center justify-content-center" style="height: 150px; width: 110px;">
                                <small class="text-muted">No Cover</small>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $book->title }}</h6>
                        <p class="text-muted small mb-3">By {{ $book->author }}</p>
                        
                        @if($book->status == 'available')
                            <a href="{{ route('bookRequest', ['bookId' => $book->id]) }}" class="btn btn-primary btn-sm w-100 shadow-sm">Request Borrow</a>
                        @else
                            <button class="btn btn-light btn-sm w-100 border text-muted" disabled>Currently Out</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No books are currently available in the catalog.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection