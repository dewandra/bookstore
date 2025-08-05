<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount(['books as voter_count' => function ($q){
            $q->join('ratings', 'books.id', '=', 'ratings.book_id')
                ->where('ratings.rating', '>', 5);
        }])
        ->orderByDesc('voter_count')
        ->take(10)
        ->get();

        return view('authors.index', compact('authors'));
    }
}
