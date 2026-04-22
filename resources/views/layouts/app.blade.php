<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Perpustakaan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen lg:h-screen lg:overflow-hidden">
    <div class="min-h-screen lg:grid lg:h-screen lg:grid-cols-[260px_1fr]">
        <aside class="border-r border-slate-200 bg-white px-6 py-8 lg:sticky lg:top-0 lg:h-screen lg:overflow-y-auto">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 19.5A2.5 2.5 0 016.5 17H20M4 19.5V6.75A2.75 2.75 0 016.75 4H20v13M4 19.5A2.5 2.5 0 006.5 22H20" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-slate-900">Perpustakaan</p>
                    <p class="text-sm text-slate-500">Admin Dashboard</p>
                </div>
            </div>

            <nav class="mt-10 space-y-2">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 4.5h7.5v7.5h-7.5zm9 0h7.5v4.5h-7.5zm0 6h7.5v9h-7.5zm-9 3h7.5v6h-7.5z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('books.index') }}" class="sidebar-link {{ request()->routeIs('books.*') ? 'sidebar-link-active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 5.25A2.25 2.25 0 016.75 3h10.5A2.25 2.25 0 0119.5 5.25v13.5a.75.75 0 01-1.12.65L12 15.94l-6.38 3.46a.75.75 0 01-1.12-.65V5.25z" />
                    </svg>
                    <span>Data Buku</span>
                </a>
            </nav>
        </aside>

        <main class="p-4 md:p-8 lg:h-screen lg:overflow-y-auto">
            <header class="mb-8 flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white px-6 py-5 shadow-sm md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm text-slate-500">Sistem Perpustakaan Sederhana</p>
                    <h1 class="text-2xl font-bold text-slate-900">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="relative" data-dropdown>
                    <button
                        type="button"
                        class="profile-button"
                        data-dropdown-toggle
                        aria-expanded="false"
                    >
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-200 font-semibold text-slate-700">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-dropdown-icon>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 9l6 6 6-6" />
                        </svg>
                    </button>

                    <div class="dropdown-menu hidden" data-dropdown-menu>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-7.5a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 006 21h7.5a2.25 2.25 0 002.25-2.25V15m-3-3h7.5m0 0l-3-3m3 3l-3 3" />
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            @if (session('success'))
                <div class="flash-alert flash-alert-success" data-flash-alert>
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75l2.25 2.25L15 9.75m6 2.25a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button type="button" class="flash-alert-close" data-flash-close>&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div class="flash-alert flash-alert-error" data-flash-alert>
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3.75m0 3.75h.008v.008H12v-.008zm9-3.758a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>{{ session('error') }}</p>
                    </div>
                    <button type="button" class="flash-alert-close" data-flash-close>&times;</button>
                </div>
            @endif

            @if (session('info'))
                <div class="flash-alert flash-alert-info" data-flash-alert>
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.25 11.25l.041-.02a.75.75 0 011.084.67v4.5m-1.125-8.25h.008v.008h-.008V8.25zm9 3.75a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>{{ session('info') }}</p>
                    </div>
                    <button type="button" class="flash-alert-close" data-flash-close>&times;</button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
