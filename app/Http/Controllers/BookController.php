<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $filterTitle = $request->input('filter.title');
        $filterAuthor = $request->input('filter.author.name');

        $booksQuery = Book::query()
            ->select('books.*', 'authors.name as author_name')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoin(DB::raw('(SELECT book_id, AVG(rating) as avg_rating FROM ratings GROUP BY book_id) as rating_summary'), 'books.id', '=', 'rating_summary.book_id')
            ->addSelect(DB::raw('IFNULL(rating_summary.avg_rating, 0) as ratings_avg_rating'));

        if ($filterTitle) {
            $booksQuery->where('books.title', 'like', '%' . $filterTitle . '%');
        }

        if ($filterAuthor) {
            $booksQuery->where('authors.name', 'like', '%' . $filterAuthor . '%');
        }

        $books = $booksQuery
            ->orderByDesc('ratings_avg_rating')
            ->paginate($perPage)
            ->withQueryString();

        return view('books.index', compact('books', 'perPage'));
    }
}
