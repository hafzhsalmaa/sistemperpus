<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Anggota;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalStock = Book::sum('stok');
        $totalAnggota = Anggota::count();
        $latestBooks = Book::latest()->take(9)->get();

        return view('dashboard.index', compact('totalBooks', 'totalStock', 'totalAnggota', 'latestBooks'));
    }
}
