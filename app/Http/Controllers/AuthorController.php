<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::query()
            ->orderByDesc('voter_count')
            ->take(10)
            ->get();

        return view('authors.index', compact('authors'));
    }
}