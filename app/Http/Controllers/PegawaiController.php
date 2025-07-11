<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }
    public function tambah()
    {
        return view('pegawai.tambah');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'posisi' => 'required',
            'gaji' => 'required|integer',
        ]);

        Pegawai::create($request->all());
        return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambahkan');
    }

     public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'posisi' => 'required',
            'gaji' => 'required|integer',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data berhasil dihapus');
    }

}