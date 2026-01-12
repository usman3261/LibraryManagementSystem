@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Library Inventory</h2>
            <p class="text-muted small">Manage your collection of books and their availability status.</p>
        </div>
        <div>
            <a href="{{ route('addBook') }}" class="btn btn-primary shadow-sm px-4">
                Add New Book
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small fw-bold">COVER</th>
                            <th class="py-3 text-secondary small fw-bold">BOOK DETAILS</th>
                            <th class="py-3 text-secondary small fw-bold">STATUS</th>
                            <th class="py-3 text-secondary small fw-bold text-center">ISSUE</th>
                            <th class="pe-4 py-3 text-secondary small fw-bold text-end">MANAGEMENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr>
                            <td class="ps-4">
                                @if($book->image)
                                    <img src="{{ asset('uploads/books/'.$book->image) }}" width="45" height="65" class="rounded shadow-sm border">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center border" style="width: 45px; height: 65px;">
                                        <small class="text-muted" style="font-size: 10px;">NO IMG</small>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $book->title }}</div>
                                <div class="text-muted small">By: {{ $book->author }}</div>
                            </td>
                            <td>
                                @if($book->status == 'available')
                                    <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3">
                                        Available
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3">
                                        Borrowed
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($book->status == 'available')
                                    <a href="{{ route('issueForm', $book->id) }}" class="btn btn-sm btn-outline-primary px-3">Issue Book</a>
                                @else
                                    <button class="btn btn-sm btn-light text-muted border px-3" disabled>Issued</button>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group shadow-sm">
                                    <form action="{{ route('bookEdit') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="edit" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-sm btn-white border-end">Edit</button>
                                    </form>

                                    <form action="{{ route('bookDelete') }}" method="post" class="d-inline" onsubmit="return confirm('Permanently remove this book from the catalog?')">
                                        @csrf
                                        <input type="hidden" name="delete" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-sm btn-white text-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                No books found in the library inventory.
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