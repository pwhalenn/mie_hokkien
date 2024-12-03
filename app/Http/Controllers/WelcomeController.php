<?php

namespace App\Http\Controllers;

use App\Models\Artikel; // Import the Artikel model

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch articles with pagination (5 per page)
        $articles = Artikel::paginate(5); // Retrieves articles with pagination

        // Pass the articles to the welcome Blade view
        return view('welcome', compact('articles'));
    }
}