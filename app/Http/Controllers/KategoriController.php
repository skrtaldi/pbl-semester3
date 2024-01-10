<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Toko;

class KategoriController extends Controller
{
    public function kategori(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if(strlen($katakunci)) {
            $kategori = Kategori::where('nama_kategori', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);
        }else {
            $kategori = Kategori::orderBy('nama_kategori', 'asc')->Paginate($jumlahbaris);
        }
        
        return view('kategori.index',compact('kategori'))->with('kategori', $kategori);
    }

    public function create() 
    {
        $kategori = Kategori::all();
        return view('kategori.create',compact('kategori'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'kode' => 'required|unique:Kategori,kode',
            'nama_kategori' => 'required',
        ], [
            'kode.required'=>'Kode wajib diisi',
            'kode.unique'=>'Kode kategori sudah ada di dalam data',
            'nama_kategori.required'=>'Nama Barang wajib diisi',
        ]);
        $kategori = [
            'kode'=>$request->kode,
            'nama_kategori'=>$request->nama_kategori,
        ];
        Kategori::create($kategori);
       return redirect()->to('kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id) 
    {
        $kategori = Kategori::where('kode', $id)->first();
        return view('kategori.edit', compact('kategori'))->with('kategori', $kategori);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ], [
            'nama_kategori.required'=>'Nama barang Barang wajib diisi',
        ]);
        $kategori = [
            'nama_kategori'=>$request->nama_kategori,
        ];
        Kategori::where('kode', $id)->update($kategori);
       return redirect()->to('kategori')->with('success', 'Berhasil melakukan update data kategori');
    }

    public function destroy($id)
    {
        // ID kategori sementara/temporary
        $temporaryKategoriId = '6';

        // Pastikan ID kategori sementara tidak sama dengan ID kategori yang akan dihapus
        if ($id == $temporaryKategoriId) {
            return redirect()->to('kategori')->with('error', 'Tidak dapat menghapus kategori sementara.');
        }

        // Update kategori_id di tabel toko ke kategori sementara untuk baris yang memiliki kategori_id yang akan dihapus
        Toko::where('kategori_id', $id)->update(['kategori_id' => $temporaryKategoriId]);

        // Hapus kategori
        Kategori::where('id', $id)->delete();
        return redirect()->to('kategori')->with('success', 'Berhasil menghapus kategori');
    }

}
