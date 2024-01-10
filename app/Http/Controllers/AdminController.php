<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\View\View;
use App\Exports\PenanggalanExport;
use App\Exports\TokoExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Penanggalan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if(strlen($katakunci)) {
            $data = Toko::where('nama', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);
        }else {
            $data = Toko::orderBy('kode', 'asc')->Paginate($jumlahbaris);
        }
        $kategori = Kategori::all();
        return view('barang.home',compact('kategori'))->with('data', $data);
    }
    
    public function create() 
    {
        $kategori = Kategori::all();
        return view('barang.create',compact('kategori'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'kode' => 'required|unique:Toko,kode',
            'nama' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'supplier' => 'required',
            'minLimit' => 'required',
            'maxLimit' => 'required',
            'kategori_id' => 'required',
        ], [
            'kode.required'=>'Kode wajib diisi',
            'kode.unique'=>'Kode barang sudah ada di dalam data',
            'nama.required'=>'Nama Barang wajib diisi',
            'jumlah.required'=>'Jumlah wajib diisi',
            'harga.required'=>'Harga wajib diisi',
            'supplier.required'=>'Supplier wajib diisi',
            'minLimit.required'=>'Min Limit wajib diisi',
            'maxLimit.required'=>'Max Limit wajib diisi',
            'kategori_id.required'=>'Kategori wajib diisi',
        ]);
        $data = [
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'jumlah'=>$request->jumlah,
            'harga'=>$request->harga,
            'supplier'=>$request->supplier,
            'minLimit'=>$request->minLimit,
            'maxLimit'=>$request->maxLimit,
            'kategori_id'=>$request->kategori_id,
        ];
        Toko::create($data);
       return redirect()->to('admin')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id) 
    {
        $kategori = Kategori::all();
        $data = Toko::where('kode', $id)->first();
        return view('barang.edit', compact('kategori'))->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'supplier' => 'required',
            'minLimit' => 'required',
            'maxLimit' => 'required',
            'kategori_id' => 'required',
        ], [
            'nama.required'=>'Nama barang Barang wajib diisi',
            'jumlah.required'=>'Jumlah wajib diisi',
            'harga.required'=>'Harga wajib diisi',
            'supplier.required'=>'Supplier wajib diisi',
            'minLimit.required'=>'Min Limit wajib diisi',
            'maxLimit.required'=>'Max Limit wajib diisi',
            'kategori_id.required'=>'Kategori wajib diisi',
        ]);
        $data = [
            'nama'=>$request->nama,
            'jumlah'=>$request->jumlah,
            'harga'=>$request->harga,
            'supplier'=>$request->supplier,
            'minLimit'=>$request->minLimit,
            'maxLimit'=>$request->maxLimit,
            'kategori_id'=>$request->kategori_id,
        ];
        Toko::where('kode', $id)->update($data);
       return redirect()->to('admin')->with('success', 'Berhasil melakukan update data produk');
    }

    public function destroy($id)
    {
        Toko::where('kode', $id)->delete();
        return redirect()->to('admin')->with('success', 'Berhasil menghapus data produk');
    }

    public function barang(Request $request)
{
    $jumlahbaris = 4;
    $kategori = Kategori::all();

    // Buat query dasar dengan join.
    $query = Toko::join('kategori', 'toko.kategori_id', '=', 'kategori.id')
                 ->select('toko.*', 'kategori.nama_kategori as kategori_nama');

    // Filter berdasarkan kategori jika diberikan
    if ($request->has('kategori_id') && $request->kategori_id != '') {
        $query->where('toko.kategori_id', $request->kategori_id);
    }

    // Jika kata kunci disediakan, tambahkan sebagai filter.
    if ($request->has('katakunci') && strlen($request->katakunci)) {
        $query->where('toko.nama', 'like', "%{$request->katakunci}%");
    }

    // Urutkan dan paginasi hasil query.
    $data = $query->orderBy('toko.kode', 'asc')->paginate($jumlahbaris);

    return view('barang.barang', ['data' => $data, 'kategori' => $kategori]);
}



    public function sidebar() 
    {
        return view('layouts.copynavigation');
    }
    public function exportExcel()
    {
        $tanggalDatabase = Penanggalan::orderBy('tanggal', 'asc')->first();

        $tanggalDatabase = $tanggalDatabase->tanggal;
        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        if ($tanggalSekarang != $tanggalDatabase) {
            $fileName = 'toko' . Carbon::now()->format('Y_m_d_His') . '.xlsx';
            
            // Ekspor dan simpan file ke folder spesifik
            Excel::store(new TokoExport, $fileName, 'local');
            
            // Salin file ke folder tujuan
            copy(storage_path('app/' . $fileName), 'C:/Users/user/Backup_Rahayu/' . $fileName);
            // 1. Hapus semua data dari tabel 'tanggalan'
            DB::table('tanggalan')->delete();

            // 2. Tambahkan tanggal saat ini ke dalam tabel 'tanggalan'
            DB::table('tanggalan')->insert([
                'tanggal' => $tanggalSekarang,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
        return redirect('dashboard');
    }

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
}
