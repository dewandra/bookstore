<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Menampilkan form rating dengan daftar penulis.
     */
    public function index()
    {
        $authors = Author::orderBy('name')->get();
        return view('ratings.index', compact('authors'));
    }

    /**
     * Menyimpan rating baru dan mengupdate kalkulasi.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        Rating::create($validatedData);

        // 1. Update rata-rata rating dan voter count untuk buku terkait
        $bookStats = Rating::where('book_id', $validatedData['book_id'])
            ->selectRaw('AVG(rating) as ratings_avg, COUNT(id) as voter_count')
            ->first();

        $book = Book::find($validatedData['book_id']);
        $book->update([
            'ratings_avg' => $bookStats->ratings_avg,
            'voter_count' => $bookStats->voter_count,
        ]);

        // 2. Hitung ulang voter_count untuk penulis buku tersebut
        $authorVoterCount = Rating::where('rating', '>', 5)
            ->whereHas('book', function ($query) use ($book) {
                $query->where('author_id', $book->author_id);
            })
            ->count();
        
        Author::where('id', $book->author_id)->update(['voter_count' => $authorVoterCount]);

        return redirect()->route('books.index')->with('success', 'Rating added successfully.');
    }

    /**
     * Mengambil daftar buku berdasarkan ID penulis untuk AJAX request.
     */
    public function getBooksByAuthor(Author $author)
    {
        $books = $author->books()->orderBy('title')->get(['id', 'title']);
        return response()->json($books);
    }
}