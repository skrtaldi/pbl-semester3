<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-size: 24px;">
        {{ __('Daftar Barang') }}
      </h2>
    </x-slot>
    
    
    <!doctype html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data Mahasiswa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
      </head>
      <body class="bg-light">
        <main class="container">
        @if(Session::has('success'))
        <div class="pt-3">
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
      @endif
      <!-- START DATA -->
      <div class="my-3 p-3 bg-body shadow-sm" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius:15px;">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3" style="display: flex; justify-content: space-between; align-items: center;">
          <div>
              <p class="fs-4 font-semibold" style="color: rgb(73, 73, 243);">Data Barang</p>
          </div>
          <div>
            <a href="{{ 'kategori' }}" class="btn btn-primary">
                <i class="fas fa-plus fa-xs"></i>
                Data Kategori
            </a>
        </div>
      </div>
              <!-- FORM PENCARIAN -->
              <div class="pb-3 d-flex" style="justify-content: space-between; align-items: center;">
                <div class="pb-3 d-flex justify-content-end">
                  <form class="d-flex" action="{{ url('barang') }}" method="get">
                      <!-- Dropdown untuk memilih kategori -->
                      <select class="form-select me-1" name="kategori_id">
                          <option value="">Pilih Kategori</option>
                          @foreach ($kategori as $item)
                              <!-- Pastikan Anda menggunakan request->input('kategori_id') untuk mendapatkan nilai saat ini -->
                              <option value="{{ $item->id }}" {{ (int) request()->input('kategori_id') === $item->id ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>
                          @endforeach
                      </select>
                      <!-- Tombol untuk submit form -->
                      <button class="btn btn-primary" type="submit">
                          Filter
                      </button>
                  </form>
              </div>                 
                <form class="d-flex w-70" action="{{ url('barang') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                </form>
                <!-- FORM FILTER KATEGORI -->
              </div>
              
              <table class="table table-striped">
                  <thead>
                      <tr class="text-center">
                          <th class="col-md-1">No</th>
                          <th class="col-md-1">Kode</th>
                          <th class="col-md-2">Nama Barang</th>
                          <th class="col-md-1">Jumlah</th>
                          <th class="col-md-1">Harga</th>
                          <th class="col-md-2">Supplier</th>
                          <th class="col-md-1">Min Limit</th>
                          <th class="col-md-1">Max Limit</th>
                          <th class="col-md-2">Kategori</th>
                          
                      </tr>
                  </thead>
                  <tbody>
                    <?php $i = $data->firstItem(); ?>
                    @foreach ($data as $item)
                    <tr class="text-center">
                      <td>{{ $i }}</td>
                      <td>{{ $item->kode }}</td>
                      <td>{{ $item->nama }}</td>
                      <td>{{ $item->jumlah }}</td>
                      <td>{{ $item->harga }}</td>
                      <td>{{ $item->supplier }}</td>
                      <td>{{ $item->minLimit }}</td>
                      <td>{{ $item->maxLimit }}</td>
                      <td>{{ $item->kategori_nama }}</td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                  </tbody>
                </table>
                  {{ $data->withQueryString()->links() }}
        </div>
        <!-- AKHIR DATA -->
      </main>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </body>
  </html>
      </x-app-layout>
  
  