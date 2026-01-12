@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class="fw-bold text-dark mb-4">Modify Book Details</h4>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('bookUpdate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="update" value="{{ $book->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Book Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Author Name</label>
                        <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">Update Cover Image</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="file" name="image" class="form-control" accept="image/*">
                            @if($book->image)
                                <img src="{{ asset('uploads/books/' . $book->image) }}" class="rounded shadow-sm border" style="height: 60px;">
                            @endif
                        </div>
                    </div>
                    <div class="d-flex gap-2 border-top pt-4">
                        <button type="submit" class="btn btn-primary px-5">Update Record</button>
                        <a href="{{ route('bookShow') }}" class="btn btn-light border px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection