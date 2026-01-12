@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class="fw-bold text-dark mb-4">Catalog Management: New Entry</h4>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('book-submit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Book Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter full book title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">Author Name</label>
                        <input type="text" name="author" class="form-control" placeholder="Enter author name" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">Cover Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="d-flex gap-2 border-top pt-4">
                        <button type="submit" class="btn btn-primary px-5">Save to Catalog</button>
                        <a href="{{ route('bookShow') }}" class="btn btn-light border px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection