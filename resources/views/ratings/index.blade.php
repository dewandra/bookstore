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

    <form method="POST" action="{{ route('ratings.store') }}" class="card p-4">
        @csrf

        {{-- Dropdown untuk Penulis --}}
        <div class="mb-3">
            <label for="author_id" class="form-label">Book Author</label>
            <select id="author-select" name="author_id" class="form-select" required>
                <option value="">-- Select Author --</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Dropdown untuk Buku (akan diisi oleh JavaScript) --}}
        <div class="mb-3">
            <label for="book_id" class="form-label">Book Name</label>
            <select id="book-select" name="book_id" class="form-select" required disabled>
                <option value="">-- Select Author First --</option>
            </select>
        </div>

        {{-- Dropdown untuk Rating --}}
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

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi Select2 untuk dropdown penulis
    $('#author-select').select2({
        placeholder: "-- Select Author --",
        width: '100%'
    });

    // Inisialisasi Select2 untuk dropdown buku
    const bookSelect = $('#book-select').select2({
        placeholder: "-- Select Author First --",
        width: '100%'
    });

    // Event listener saat dropdown penulis berubah
    $('#author-select').on('change', function() {
        const authorId = $(this).val();
        
        // Kosongkan dan nonaktifkan dropdown buku
        bookSelect.empty().append('<option value="">Loading...</option>').prop('disabled', true);

        if (authorId) {
            // Jika penulis dipilih, ambil data buku via AJAX
            $.ajax({
                url: `/authors/${authorId}/books`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    bookSelect.empty().append('<option value="">-- Select Book --</option>');
                    if (data.length > 0) {
                        $.each(data, function(key, book) {
                            bookSelect.append(`<option value="${book.id}">${book.title}</option>`);
                        });
                        bookSelect.prop('disabled', false);
                    } else {
                        bookSelect.empty().append('<option value="">-- No books found for this author --</option>');
                    }
                },
                error: function() {
                    bookSelect.empty().append('<option value="">-- Could not load books --</option>');
                }
            });
        } else {
            // Jika tidak ada penulis yang dipilih
            bookSelect.empty().append('<option value="">-- Select Author First --</option>');
        }
    });
});
</script>
@endpush