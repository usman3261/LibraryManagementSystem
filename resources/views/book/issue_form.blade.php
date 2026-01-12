@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h4 class="fw-bold text-dark mb-4">Process Book Issue</h4>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="bg-light p-3 rounded mb-4">
                    <small class="text-secondary d-block">Issuing Title:</small>
                    <h5 class="fw-bold mb-0 text-primary">{{ $book->title }}</h5>
                </div>
                
                <form action="{{ route('issueBook') }}" method="post">
                    @csrf
                    <input type="hidden" name="bookId" value="{{ $book->id }}">

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">Select Authorized Student</label>
                        <select name="studentId" class="form-select form-select-lg" required>
                            <option value="">-- Choose Student --</option>
                            @forelse($students as $student)
                                <option value="{{ $student->id }}">
                                    {{ $student->first_name }} {{ $student->last_name }} ({{ $student->email }})
                                </option>
                            @empty
                                 <option value="" disabled>No Student users found.</option>
                            @endforelse
                        </select>
                    </div>
                    
                    <div class="alert alert-warning border-0 small mb-4">
                        Note: The due date will be set automatically to 7 days from today.
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">Confirm Issue</button>
                        <a href="{{ route('bookShow') }}" class="btn btn-link text-secondary text-decoration-none">Cancel and Exit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection