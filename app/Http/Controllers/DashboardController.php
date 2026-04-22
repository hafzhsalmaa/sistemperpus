<?php

namespace App\Http\Controllers;

use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalStock = Book::sum('stok');
        $latestBooks = Book::latest()->take(9)->get();

        return view('dashboard.index', compact('totalBooks', 'totalStock', 'latestBooks'));
    }
}
