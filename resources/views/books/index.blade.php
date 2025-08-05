@extends('layouts.app')

@section('content')
    <h1 class="mb-4">List of Books</h1>

    <form method="GET" class="row mb-3 align-items-center">
        {{-- Input Pencarian Tunggal --}}
        <div class="col-md-8">
            <input type="text" name="search" class="form-control" placeholder="Search by Book Title or Author Name..." value="{{ request('search') }}">
        </div>

        {{-- Dropdown Per Halaman --}}
        <div class="col-md-2">
            <select name="per_page" class="form-select" onchange="this.form.submit()">
                @foreach(range(10, 100, 10) as $count)
                    <option value="{{ $count }}" {{ $perPage == $count ? 'selected' : '' }}>{{ $count }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Submit --}}
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    {{-- Tabel tetap sama --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Average Rating</th>
                <th>Voter</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author_name }}</td>
                    <td>{{ $book->category_name }}</td>
                    <td>{{ number_format($book->ratings_avg_rating, 2) }}</td>
                    <td>{{ $book->voter_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No books found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@endsection