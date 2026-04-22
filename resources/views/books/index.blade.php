@extends('layouts.app')

@php
    $openModal = session('open_modal');
    $editBookId = session('edit_book_id');
    $selectedBook = $editBookId ? $books->firstWhere('id', $editBookId) : null;
@endphp

@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('content')
    <section class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="section-heading">
            <div class="icon-badge icon-badge-blue">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5A2.25 2.25 0 0119.5 5.25v13.5a.75.75 0 01-1.12.65L12 15.94l-6.38 3.46a.75.75 0 01-1.12-.65V5.25z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-900">Daftar Buku</h2>
                <p class="text-sm text-slate-500">Kelola data buku perpustakaan melalui halaman CRUD sederhana.</p>
            </div>
        </div>

        <button type="button" class="btn-primary gap-2" data-modal-open="create-book-modal">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Tambah Buku</span>
        </button>
    </section>

    <section class="table-wrapper">
        <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="icon-badge icon-badge-emerald h-10 w-10 rounded-xl bg-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5A2.25 2.25 0 0119.5 5.25v13.5a.75.75 0 01-1.12.65L12 15.94l-6.38 3.46a.75.75 0 01-1.12-.65V5.25z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-900">Tabel Data Buku</p>
                    <p class="text-xs text-slate-500">Total data pada halaman ini: {{ $books->count() }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Kode</th>
                        <th class="px-6 py-4 font-semibold">Judul</th>
                        <th class="px-6 py-4 font-semibold">Penulis</th>
                        <th class="px-6 py-4 font-semibold">Penerbit</th>
                        <th class="px-6 py-4 font-semibold">Tahun</th>
                        <th class="px-6 py-4 font-semibold">Stok</th>
                        <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                    @forelse ($books as $book)
                        <tr class="transition hover:bg-slate-50/80">
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                    {{ $book->kode_buku }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $book->judul }}</td>
                            <td class="px-6 py-4">{{ $book->penulis }}</td>
                            <td class="px-6 py-4">{{ $book->penerbit }}</td>
                            <td class="px-6 py-4">{{ $book->tahun_terbit }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">
                                    {{ $book->stok }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button
                                        type="button"
                                        class="btn-secondary gap-2"
                                        data-edit-book
                                        data-update-url="{{ route('books.update', $book) }}"
                                        data-kode-buku="{{ $book->kode_buku }}"
                                        data-judul="{{ $book->judul }}"
                                        data-penulis="{{ $book->penulis }}"
                                        data-penerbit="{{ $book->penerbit }}"
                                        data-tahun-terbit="{{ $book->tahun_terbit }}"
                                        data-stok="{{ $book->stok }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.86 4.487l2.652 2.652a1.875 1.875 0 010 2.652L9.75 19.553 4.5 21l1.447-5.25L15.71 4.487a1.875 1.875 0 012.651 0z" />
                                        </svg>
                                        <span>Edit</span>
                                    </button>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" data-delete-form>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table-action-danger gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 7.5h12m-9.75 0V6A2.25 2.25 0 0110.5 3.75h3A2.25 2.25 0 0115.75 6v1.5m-8.25 0v10.125A2.625 2.625 0 0010.125 20.25h3.75A2.625 2.625 0 0016.5 17.625V7.5" />
                                            </svg>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10">
                                <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-8 text-center">
                                    <div class="icon-badge icon-badge-amber h-12 w-12 rounded-2xl bg-white shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5A2.25 2.25 0 0119.5 5.25v13.5a.75.75 0 01-1.12.65L12 15.94l-6.38 3.46a.75.75 0 01-1.12-.65V5.25z" />
                                        </svg>
                                    </div>
                                    <p class="mt-4 text-sm font-semibold text-slate-900">Belum ada data buku</p>
                                    <p class="mt-1 text-sm text-slate-500">Tambahkan data buku baru agar tabel mulai terisi.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 px-6 py-4">
            {{ $books->links() }}
        </div>
    </section>

    <div
        id="create-book-modal"
        class="modal {{ $openModal === 'create' ? '' : 'hidden' }}"
        data-modal
        @if ($openModal === 'create')
            data-open-on-load="true"
        @endif
    >
        <div class="modal-backdrop" data-modal-close></div>
        <div class="modal-panel">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div class="section-heading">
                    <div class="icon-badge icon-badge-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Tambah Buku</h3>
                        <p class="text-sm text-slate-500">Isi data buku baru dengan lengkap.</p>
                    </div>
                </div>
                <button type="button" class="modal-close-button" data-modal-close>&times;</button>
            </div>

            <form action="{{ route('books.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="create_kode_buku" class="text-sm font-semibold text-slate-700">Kode Buku</label>
                        <input type="text" id="create_kode_buku" name="kode_buku" value="{{ $openModal === 'create' ? old('kode_buku') : '' }}" class="form-input" placeholder="Contoh: BK-005">
                        @if ($openModal === 'create')
                            @error('kode_buku')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_judul" class="text-sm font-semibold text-slate-700">Judul</label>
                        <input type="text" id="create_judul" name="judul" value="{{ $openModal === 'create' ? old('judul') : '' }}" class="form-input" placeholder="Masukkan judul buku">
                        @if ($openModal === 'create')
                            @error('judul')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_penulis" class="text-sm font-semibold text-slate-700">Penulis</label>
                        <input type="text" id="create_penulis" name="penulis" value="{{ $openModal === 'create' ? old('penulis') : '' }}" class="form-input" placeholder="Masukkan penulis">
                        @if ($openModal === 'create')
                            @error('penulis')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_penerbit" class="text-sm font-semibold text-slate-700">Penerbit</label>
                        <input type="text" id="create_penerbit" name="penerbit" value="{{ $openModal === 'create' ? old('penerbit') : '' }}" class="form-input" placeholder="Masukkan penerbit">
                        @if ($openModal === 'create')
                            @error('penerbit')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_tahun_terbit" class="text-sm font-semibold text-slate-700">Tahun Terbit</label>
                        <input type="number" id="create_tahun_terbit" name="tahun_terbit" value="{{ $openModal === 'create' ? old('tahun_terbit') : '' }}" class="form-input" placeholder="Contoh: 2024">
                        @if ($openModal === 'create')
                            @error('tahun_terbit')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_stok" class="text-sm font-semibold text-slate-700">Stok</label>
                        <input type="number" id="create_stok" name="stok" value="{{ $openModal === 'create' ? old('stok') : '' }}" class="form-input" placeholder="Masukkan stok">
                        @if ($openModal === 'create')
                            @error('stok')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="submit" class="btn-primary gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Simpan Buku</span>
                    </button>
                    <button type="button" class="btn-secondary" data-modal-close>Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div
        id="edit-book-modal"
        class="modal {{ $openModal === 'edit' ? '' : 'hidden' }}"
        data-modal
        @if ($openModal === 'edit' && $selectedBook)
            data-update-url="{{ route('books.update', $selectedBook) }}"
            data-kode-buku="{{ old('kode_buku') }}"
            data-judul="{{ old('judul') }}"
            data-penulis="{{ old('penulis') }}"
            data-penerbit="{{ old('penerbit') }}"
            data-tahun-terbit="{{ old('tahun_terbit') }}"
            data-stok="{{ old('stok') }}"
        @endif
        @if ($openModal === 'edit')
            data-open-on-load="true"
        @endif
    >
        <div class="modal-backdrop" data-modal-close></div>
        <div class="modal-panel">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div class="section-heading">
                    <div class="icon-badge icon-badge-violet">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.86 4.487l2.652 2.652a1.875 1.875 0 010 2.652L9.75 19.553 4.5 21l1.447-5.25L15.71 4.487a1.875 1.875 0 012.651 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Edit Buku</h3>
                        <p class="text-sm text-slate-500">Perbarui data buku pada form berikut.</p>
                    </div>
                </div>
                <button type="button" class="modal-close-button" data-modal-close>&times;</button>
            </div>

            <form
                action="{{ $selectedBook ? route('books.update', $selectedBook) : route('books.update', 0) }}"
                method="POST"
                class="space-y-6"
                id="edit-book-form"
            >
                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="edit_kode_buku" class="text-sm font-semibold text-slate-700">Kode Buku</label>
                        <input type="text" id="edit_kode_buku" name="kode_buku" value="{{ $openModal === 'edit' ? old('kode_buku') : '' }}" class="form-input" placeholder="Contoh: BK-001">
                        @if ($openModal === 'edit')
                            @error('kode_buku')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_judul" class="text-sm font-semibold text-slate-700">Judul</label>
                        <input type="text" id="edit_judul" name="judul" value="{{ $openModal === 'edit' ? old('judul') : '' }}" class="form-input" placeholder="Masukkan judul buku">
                        @if ($openModal === 'edit')
                            @error('judul')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_penulis" class="text-sm font-semibold text-slate-700">Penulis</label>
                        <input type="text" id="edit_penulis" name="penulis" value="{{ $openModal === 'edit' ? old('penulis') : '' }}" class="form-input" placeholder="Masukkan penulis">
                        @if ($openModal === 'edit')
                            @error('penulis')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_penerbit" class="text-sm font-semibold text-slate-700">Penerbit</label>
                        <input type="text" id="edit_penerbit" name="penerbit" value="{{ $openModal === 'edit' ? old('penerbit') : '' }}" class="form-input" placeholder="Masukkan penerbit">
                        @if ($openModal === 'edit')
                            @error('penerbit')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_tahun_terbit" class="text-sm font-semibold text-slate-700">Tahun Terbit</label>
                        <input type="number" id="edit_tahun_terbit" name="tahun_terbit" value="{{ $openModal === 'edit' ? old('tahun_terbit') : '' }}" class="form-input" placeholder="Contoh: 2024">
                        @if ($openModal === 'edit')
                            @error('tahun_terbit')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_stok" class="text-sm font-semibold text-slate-700">Stok</label>
                        <input type="number" id="edit_stok" name="stok" value="{{ $openModal === 'edit' ? old('stok') : '' }}" class="form-input" placeholder="Masukkan stok">
                        @if ($openModal === 'edit')
                            @error('stok')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="submit" class="btn-primary gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.86 4.487l2.652 2.652a1.875 1.875 0 010 2.652L9.75 19.553 4.5 21l1.447-5.25L15.71 4.487a1.875 1.875 0 012.651 0z" />
                        </svg>
                        <span>Update Buku</span>
                    </button>
                    <button type="button" class="btn-secondary" data-modal-close>Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection
