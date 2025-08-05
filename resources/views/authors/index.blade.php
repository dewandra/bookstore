@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Top 10 Most Famous Authors</h1>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Author Name</th>
                <th>Voter Count (Rating > 5)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($authors as $index => $author)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->voter_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No author found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
