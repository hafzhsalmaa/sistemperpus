<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('id', 'asc')->paginate(5);

        return view('books.index', compact('books'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_buku' => ['required', 'string', 'max:50', 'unique:books,kode_buku'],
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'penerbit' => ['required', 'string', 'max:255'],
            'tahun_terbit' => ['required', 'integer'],
            'stok' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('books.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'create');
        }

        $validated = $validator->validated();

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'kode_buku' => ['required', 'string', 'max:50', 'unique:books,kode_buku,'.$book->id],
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'penerbit' => ['required', 'string', 'max:255'],
            'tahun_terbit' => ['required', 'integer'],
            'stok' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('books.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'edit')
                ->with('edit_book_id', $book->id);
        }

        $validated = $validator->validated();

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Data buku berhasil dihapus.');
    }
}
