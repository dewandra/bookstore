<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->orderBy('title')->limit(1000)->get();

        return view('ratings.index', compact('books'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        Rating::create($validatedData);

        return redirect()->route('ratings.index')->with('success', 'Rating added successfully.');
    }
}
