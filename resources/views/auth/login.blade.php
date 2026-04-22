<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $heroImageDirectory = public_path('images/bg-login');
    $heroImage = \Illuminate\Support\Facades\File::isDirectory($heroImageDirectory)
        ? collect(\Illuminate\Support\Facades\File::files($heroImageDirectory))->first(function ($file) {
            return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp', 'svg']);
        })
        : null;
@endphp

<body class="min-h-screen bg-[radial-gradient(circle_at_top,#e0f2fe,#f8fafc_45%,#e2e8f0)]">
    <main class="mx-auto flex min-h-screen max-w-6xl items-center px-4 py-10">
        <div class="grid w-full gap-8 lg:grid-cols-[1.15fr_0.85fr]">
            <section class="relative hidden overflow-hidden rounded-4xl shadow-xl lg:block">
                <img src="{{ asset('images/bg-login.png') }}" alt="Ilustrasi perpustakaan"
                    class="absolute inset-0 h-full w-full object-cover">
            </section>

            <section class="auth-card p-8 md:p-10">
                <div class="mx-auto max-w-md">
                    <div class="mb-8 justify-center text-center">
                        <p class="text-sm font-medium uppercase tracking-[0.25em] text-sky-600">Login Admin</p>
                        <h2 class="mt-3 text-3xl font-bold text-slate-900">Sistem Perpustakaan</h2>
                        <p class="mt-2 text-sm text-slate-500">Gunakan akun admin untuk mulai mengelola data buku.</p>
                    </div>

                    @if ($errors->any())
                        <div class="flash-alert flash-alert-error" data-flash-alert>
                            <div class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3.75m0 3.75h.008v.008H12v-.008zm9-3.758a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p>{{ $errors->first() }}</p>
                            </div>
                            <button type="button" class="flash-alert-close" data-flash-close>&times;</button>
                        </div>
                    @endif

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

                    <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', 'admin@perpus.com') }}"
                                class="form-input" placeholder="Masukkan email">
                        </div>

                        <div>
                            <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" class="form-input pr-12"
                                    placeholder="Masukkan password" data-password-input>
                                <button type="button" class="password-toggle" data-password-toggle aria-label="Lihat password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-eye-open>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14.25A2.25 2.25 0 1012 9.75a2.25 2.25 0 000 4.5z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-eye-close>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3l18 18" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.73 5.08A10.94 10.94 0 0112 5.25c6 0 9.75 6.75 9.75 6.75a18.77 18.77 0 01-4.02 4.95M6.61 6.61A18.72 18.72 0 002.25 12S6 18.75 12 18.75c1.64 0 3.1-.5 4.39-1.23M9.88 9.88A2.99 2.99 0 0012 15a3 3 0 002.12-.88" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            Login
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </main>
</body>

</html>
