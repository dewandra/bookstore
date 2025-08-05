@extends('layouts.app')

@section('content')
    <h1 class="mb-4">List of Books</h1>

    <form method="GET" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="filter[title]" class="form-control" placeholder="Search by book title" value="{{ request('filter.title') }}">
        </div>
        <div class="col-md-4">
            <input type="text" name="filter[author.name]" class="form-control" placeholder="Search by author" value="{{ request('filter.author.name') }}">
        </div>
        <div class="col-md-2">
            <select name="per_page" class="form-select" onchange="this.form.submit()">
                @foreach(range(10, 100, 10) as $count)
                    <option value="{{ $count }}" {{ $perPage == $count ? 'selected' : '' }}>{{ $count }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Average Rating</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author_name }}</td>
                    <td>{{ number_format($book->ratings_avg_rating, 2) ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No books found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@endsection
