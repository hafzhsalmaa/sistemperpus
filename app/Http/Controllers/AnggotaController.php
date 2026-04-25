<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::orderBy('id', 'asc')->paginate(5);

        return view('anggota.index', compact('anggota'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_anggota' => ['required', 'string', 'max:50', 'unique:anggota,kode_anggota'],
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'string', 'max:20'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('anggota.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'create');
        }

        Anggota::create($validator->validated());

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validator = Validator::make($request->all(), [
            'kode_anggota' => ['required', 'string', 'max:50', 'unique:anggota,kode_anggota,'.$anggota->id],
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'string', 'max:20'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('anggota.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'edit')
                ->with('edit_anggota_id', $anggota->id);
        }

        $anggota->update($validator->validated());

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}
