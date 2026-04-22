@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <div class="dashboard-card">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Buku</p>
                    <h2 class="mt-4 text-4xl font-bold text-slate-900">{{ $totalBooks }}</h2>
                    <p class="mt-2 text-sm text-slate-500">Jumlah judul buku yang tersimpan.</p>
                </div>
                <div class="icon-badge icon-badge-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5A2.25 2.25 0 0119.5 5.25v13.5a.75.75 0 01-1.12.65L12 15.94l-6.38 3.46a.75.75 0 01-1.12-.65V5.25z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Stok</p>
                    <h2 class="mt-4 text-4xl font-bold text-slate-900">{{ $totalStock }}</h2>
                    <p class="mt-2 text-sm text-slate-500">Total seluruh stok buku yang tersedia.</p>
                </div>
                <div class="icon-badge icon-badge-emerald">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6.75h16.5M6.75 3.75v6m10.5-6v6M6 20.25h12A2.25 2.25 0 0020.25 18V9A2.25 2.25 0 0018 6.75H6A2.25 2.25 0 003.75 9v9A2.25 2.25 0 006 20.25z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="dashboard-card md:col-span-2 xl:col-span-1">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Sambutan</p>
                    <h2 class="mt-4 text-2xl font-bold text-slate-900">Selamat datang, {{ auth()->user()->name }}</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Kelola data perpustakaan dengan cepat melalui menu dashboard dan data buku.
                    </p>
                </div>
                <div class="icon-badge icon-badge-amber">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zm-9 13.5a6.75 6.75 0 0113.5 0" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-8">
        <div class="dashboard-card">
            <div class="section-heading">
                <div class="icon-badge icon-badge-violet">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5A2.25 2.25 0 0119.5 5.25v13.5a.75.75 0 01-1.12.65L12 15.94l-6.38 3.46a.75.75 0 01-1.12-.65V5.25z" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-slate-900">Buku Terbaru</p>
                    <p class="mt-1 text-sm text-slate-500">Menampilkan 9 buku terbaru yang ada di sistem.</p>
                </div>
            </div>

            <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($latestBooks as $book)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $book->judul }}</p>
                                <p class="mt-1 text-sm text-slate-500">{{ $book->penulis }}</p>
                            </div>
                            <div class="icon-badge icon-badge-indigo h-10 w-10 rounded-xl bg-white/80 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5A2.25 2.25 0 0119.5 5.25v13.5a.75.75 0 01-1.12.65L12 15.94l-6.38 3.46a.75.75 0 01-1.12-.65V5.25z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 inline-flex rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-600 shadow-sm">
                            Stok {{ $book->stok }}
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center text-sm text-slate-500 md:col-span-2 xl:col-span-3">
                        Belum ada data buku.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
