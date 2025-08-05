@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Rate a Book</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/rate') }}" class="card p-4">
        @csrf

        <div class="mb-3">
            <label for="book_id" class="form-label">Book</label>
                <select id="book-select" name="book_id" class="form-select" required>
                    <option>-- Select Book --</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">
                            {{ $book->title }} by {{ $book->author->name }}
                        </option>
                    @endforeach
                </select>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select name="rating" class="form-select" required>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit Rating</button>
    </form>
@endsection
