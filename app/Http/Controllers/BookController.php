<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $booksQuery = Book::query()
            ->select('books.*', 'authors.name as author_name', 'categories.name as category_name')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id');

        if ($search) {
            $booksQuery->where(function ($query) use ($search) {
                $query->where('books.title', 'like', '%' . $search . '%')
                      ->orWhere('authors.name', 'like', '%' . $search . '%');
            });
        }
        
        $booksQuery->addSelect(
            'books.ratings_avg as ratings_avg_rating',
            'books.voter_count'
        );

        $books = $booksQuery
            ->orderByDesc('books.ratings_avg')
            ->paginate($perPage)
            ->withQueryString();

        return view('books.index', compact('books', 'perPage'));
    }
}