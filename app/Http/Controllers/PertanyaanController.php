<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class PertanyaanController extends Controller
{
    public function index()
    {
        $title = 'Data Pertanyaan';
        $pertanyaan = DB::table('pertanyaan')->get();
        return view('pertanyaan.index', compact('title', 'pertanyaan'));
    }

    public function create()
    {
        $title = 'Tambah Pertanyaan';
        return view('pertanyaan.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        DB::table('pertanyaan')->insert([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect(url('/pertanyaan'))->with('status', 'Data Berhasil Ditambahkan!');
    }

    public function show($id)
    {
        $title = 'Detail Pertanyaan';
        $p = DB::table('pertanyaan')->where('id', $id)->first();
        return view('pertanyaan.show', compact('title', 'p'));
    }

    public function edit($id)
    {
        $title = 'Perbaharui Pertanyaan';
        $p = DB::table('pertanyaan')->where('id', $id)->first();
        return view('pertanyaan.edit', compact('title', 'p'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        DB::table('pertanyaan')->where('id', $id)->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal_diperbaharui' => new DateTime()
        ]);

        return redirect(url('/pertanyaan'))->with('status', 'Data Berhasil Diperbaharui!');
    }

    public function destroy($id)
    {
        DB::table('pertanyaan')->where('id', $id)->delete();

        return redirect(url('/pertanyaan'))->with('status', 'Data berhasil dihapus');
    }
}
