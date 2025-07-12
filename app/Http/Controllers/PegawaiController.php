<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Insentif;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = pegawai::all();
        $insentifs = Insentif::all(); 
        return view('pegawai.index', compact('pegawai', 'insentifs'));
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

    public function importInsentif(Request $request)
    {
        $file = $request->file('file');

        if (($handle = fopen($file, 'r')) !== false) {
            fgetcsv($handle, 1000, ';');
            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                if (count($data) >= 4) {
                    Insentif::create([
                        'nama'           => $data[0],
                        'jumlah_lembur'  => $data[1],
                        'jumlah_absen'   => $data[2],
                        'insentif'       => $data[3],
                    ]);
                }
            }
            fclose($handle);
        }
        return redirect()->back()->with('success', 'CSV berhasil diimport!');
    }
    public function exportInsentif()
    {
        $fileName = 'insentif.csv';
        $insentifs = \App\Models\Insentif::all();
    
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
    
        $columns = ['ID', 'Nama', 'Jumlah Lembur', 'Jumlah Absen', 'Insentif'];
    
        $callback = function() use ($insentifs, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
        
            foreach ($insentifs as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->nama,
                    $row->jumlah_lembur,
                    $row->jumlah_absen,
                    $row->insentif
                ]);
            }
        
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }
    public function hapusSemuaInsentif()
    {
        \App\Models\Insentif::truncate();
        return redirect()->back()->with('success', 'Semua data insentif berhasil dihapus!');
    }

}