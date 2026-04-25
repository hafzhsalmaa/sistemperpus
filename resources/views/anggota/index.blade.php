@extends('layouts.app')

@php
    $openModal = session('open_modal');
    $editAnggotaId = session('edit_anggota_id');
    $selectedAnggota = $editAnggotaId ? $anggota->firstWhere('id', $editAnggotaId) : null;
@endphp

@section('title', 'Data Anggota')
@section('page-title', 'Data Anggota')

@section('content')
    <section class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="section-heading">
            {{-- <div class="icon-badge icon-badge-indigo">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zm-9 13.5a6.75 6.75 0 0113.5 0M18.75 8.25a2.625 2.625 0 110 5.25m1.5 6.75a4.5 4.5 0 00-3-4.25" />
                </svg>
            </div> --}}
            {{-- <div>
                <h2 class="text-xl font-bold text-slate-900">Daftar Anggota</h2>
                <p class="text-sm text-slate-500">Kelola data anggota perpustakaan melalui halaman CRUD sederhana.</p>
            </div> --}}
        </div>

        <button type="button" class="btn-primary gap-2" data-modal-open="create-anggota-modal">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Tambah Anggota</span>
        </button>
    </section>

    <section class="table-wrapper">
        <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="icon-badge icon-badge-emerald h-10 w-10 rounded-xl bg-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zm-9 13.5a6.75 6.75 0 0113.5 0" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-900">Tabel Data Anggota</p>
                    <p class="text-xs text-slate-500">Total data pada halaman ini: {{ $anggota->count() }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Kode</th>
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Kelas</th>
                        <th class="px-6 py-4 font-semibold">Jenis Kelamin</th>
                        <th class="px-6 py-4 font-semibold">No HP</th>
                        <th class="px-6 py-4 font-semibold">Alamat</th>
                        <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                    @forelse ($anggota as $item)
                        <tr class="transition hover:bg-slate-50/80">
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                    {{ $item->kode_anggota }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $item->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                    {{ $item->kelas }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">
                                    {{ $item->jenis_kelamin }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $item->no_hp ?? '-' }}</td>
                            <td class="max-w-xs px-6 py-4">{{ $item->alamat ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button
                                        type="button"
                                        class="btn-secondary gap-2"
                                        data-edit-anggota
                                        data-update-url="{{ route('anggota.update', $item) }}"
                                        data-kode-anggota="{{ $item->kode_anggota }}"
                                        data-nama="{{ $item->nama }}"
                                        data-kelas="{{ $item->kelas }}"
                                        data-jenis-kelamin="{{ $item->jenis_kelamin }}"
                                        data-no-hp="{{ $item->no_hp }}"
                                        data-alamat="{{ $item->alamat }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.86 4.487l2.652 2.652a1.875 1.875 0 010 2.652L9.75 19.553 4.5 21l1.447-5.25L15.71 4.487a1.875 1.875 0 012.651 0z" />
                                        </svg>
                                        <span>Edit</span>
                                    </button>
                                    <form action="{{ route('anggota.destroy', $item) }}" method="POST" data-delete-form data-delete-message="Yakin ingin menghapus data anggota ini?">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zm-9 13.5a6.75 6.75 0 0113.5 0" />
                                        </svg>
                                    </div>
                                    <p class="mt-4 text-sm font-semibold text-slate-900">Belum ada data anggota</p>
                                    <p class="mt-1 text-sm text-slate-500">Tambahkan data anggota baru agar tabel mulai terisi.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 px-6 py-4">
            {{ $anggota->links() }}
        </div>
    </section>

    <div
        id="create-anggota-modal"
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
                    <div class="icon-badge icon-badge-indigo">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Tambah Anggota</h3>
                        <p class="text-sm text-slate-500">Isi data anggota baru dengan lengkap.</p>
                    </div>
                </div>
                <button type="button" class="modal-close-button" data-modal-close>&times;</button>
            </div>

            <form action="{{ route('anggota.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="create_kode_anggota" class="text-sm font-semibold text-slate-700">Kode Anggota</label>
                        <input type="text" id="create_kode_anggota" name="kode_anggota" value="{{ $openModal === 'create' ? old('kode_anggota') : '' }}" class="form-input" placeholder="Contoh: AG-001">
                        @if ($openModal === 'create')
                            @error('kode_anggota')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_nama" class="text-sm font-semibold text-slate-700">Nama</label>
                        <input type="text" id="create_nama" name="nama" value="{{ $openModal === 'create' ? old('nama') : '' }}" class="form-input" placeholder="Masukkan nama anggota">
                        @if ($openModal === 'create')
                            @error('nama')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_kelas" class="text-sm font-semibold text-slate-700">Kelas</label>
                        <input type="text" id="create_kelas" name="kelas" value="{{ $openModal === 'create' ? old('kelas') : '' }}" class="form-input" placeholder="Contoh: 12 IPA 1">
                        @if ($openModal === 'create')
                            @error('kelas')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_jenis_kelamin" class="text-sm font-semibold text-slate-700">Jenis Kelamin</label>
                        <select id="create_jenis_kelamin" name="jenis_kelamin" class="form-input">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" @selected($openModal === 'create' && old('jenis_kelamin') === 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected($openModal === 'create' && old('jenis_kelamin') === 'Perempuan')>Perempuan</option>
                        </select>
                        @if ($openModal === 'create')
                            @error('jenis_kelamin')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_no_hp" class="text-sm font-semibold text-slate-700">No HP</label>
                        <input type="text" id="create_no_hp" name="no_hp" value="{{ $openModal === 'create' ? old('no_hp') : '' }}" class="form-input" placeholder="Masukkan no HP">
                        @if ($openModal === 'create')
                            @error('no_hp')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="create_alamat" class="text-sm font-semibold text-slate-700">Alamat</label>
                        <textarea id="create_alamat" name="alamat" class="form-input min-h-28" placeholder="Masukkan alamat">{{ $openModal === 'create' ? old('alamat') : '' }}</textarea>
                        @if ($openModal === 'create')
                            @error('alamat')
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
                        <span>Simpan Anggota</span>
                    </button>
                    <button type="button" class="btn-secondary" data-modal-close>Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div
        id="edit-anggota-modal"
        class="modal {{ $openModal === 'edit' ? '' : 'hidden' }}"
        data-modal
        @if ($openModal === 'edit' && $selectedAnggota)
            data-update-url="{{ route('anggota.update', $selectedAnggota) }}"
            data-kode-anggota="{{ old('kode_anggota') }}"
            data-nama="{{ old('nama') }}"
            data-kelas="{{ old('kelas') }}"
            data-jenis-kelamin="{{ old('jenis_kelamin') }}"
            data-no-hp="{{ old('no_hp') }}"
            data-alamat="{{ old('alamat') }}"
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
                        <h3 class="text-xl font-bold text-slate-900">Edit Anggota</h3>
                        <p class="text-sm text-slate-500">Perbarui data anggota pada form berikut.</p>
                    </div>
                </div>
                <button type="button" class="modal-close-button" data-modal-close>&times;</button>
            </div>

            <form
                action="{{ $selectedAnggota ? route('anggota.update', $selectedAnggota) : route('anggota.update', 0) }}"
                method="POST"
                class="space-y-6"
                id="edit-anggota-form"
            >
                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="edit_kode_anggota" class="text-sm font-semibold text-slate-700">Kode Anggota</label>
                        <input type="text" id="edit_kode_anggota" name="kode_anggota" value="{{ $openModal === 'edit' ? old('kode_anggota') : '' }}" class="form-input" placeholder="Contoh: AG-001">
                        @if ($openModal === 'edit')
                            @error('kode_anggota')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_nama" class="text-sm font-semibold text-slate-700">Nama</label>
                        <input type="text" id="edit_nama" name="nama" value="{{ $openModal === 'edit' ? old('nama') : '' }}" class="form-input" placeholder="Masukkan nama anggota">
                        @if ($openModal === 'edit')
                            @error('nama')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_kelas" class="text-sm font-semibold text-slate-700">Kelas</label>
                        <input type="text" id="edit_kelas" name="kelas" value="{{ $openModal === 'edit' ? old('kelas') : '' }}" class="form-input" placeholder="Contoh: 12 IPA 1">
                        @if ($openModal === 'edit')
                            @error('kelas')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_jenis_kelamin" class="text-sm font-semibold text-slate-700">Jenis Kelamin</label>
                        <select id="edit_jenis_kelamin" name="jenis_kelamin" class="form-input">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" @selected($openModal === 'edit' && old('jenis_kelamin') === 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected($openModal === 'edit' && old('jenis_kelamin') === 'Perempuan')>Perempuan</option>
                        </select>
                        @if ($openModal === 'edit')
                            @error('jenis_kelamin')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_no_hp" class="text-sm font-semibold text-slate-700">No HP</label>
                        <input type="text" id="edit_no_hp" name="no_hp" value="{{ $openModal === 'edit' ? old('no_hp') : '' }}" class="form-input" placeholder="Masukkan no HP">
                        @if ($openModal === 'edit')
                            @error('no_hp')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div>
                        <label for="edit_alamat" class="text-sm font-semibold text-slate-700">Alamat</label>
                        <textarea id="edit_alamat" name="alamat" class="form-input min-h-28" placeholder="Masukkan alamat">{{ $openModal === 'edit' ? old('alamat') : '' }}</textarea>
                        @if ($openModal === 'edit')
                            @error('alamat')
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
                        <span>Update Anggota</span>
                    </button>
                    <button type="button" class="btn-secondary" data-modal-close>Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection
