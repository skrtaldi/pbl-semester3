<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-size: 24px;">
        {{ __('Daftar Kategori') }}
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
      <a href='{{ url('barang') }}' class="btn btn-secondary btn-md mt-4"> < Kembali</a>
      <div class="my-3 p-3 bg-body shadow-sm" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius:15px;">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3" style="display: flex; justify-content: space-between; align-items: center;">
          <div>
              <p class="fs-4 font-semibold" style="color: rgb(73, 73, 243);">Data Kategori</p>
          </div>
          <div>
            <a href="{{ 'kategori/create' }}" class="btn btn-primary">
                <i class="fas fa-plus fa-xs"></i>
                Tambah Kategori
            </a>
        </div>
      </div>
              <!-- FORM PENCARIAN -->
              <div class="pb-3 d-flex justify-content-end">
                <form class="d-flex w-70" action="{{ url('kategori') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                </form>
              </div>
              
        
              <table class="table table-striped">
                  <thead>
                      <tr class="text-center">
                          <th class="col-md-1">No</th>
                          <th class="col-md-1">Kode</th>
                          <th class="col-md-2">Nama Kategori</th>
                          <th class="col-md-2">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $k = $kategori->firstItem(); ?>
                    @foreach ($kategori as $item)
                    <tr class="text-center">
                      <td>{{ $k }}</td>
                      <td>{{ $item->kode }}</td>
                      <td>{{ $item->nama_kategori }}</td>
                      <td>
                        <div class="text-center">
                          <a href='{{ url('kategori/'.$item->kode.'/edit') }}' class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Edit
                          </a>
                          <form onsubmit="return confirm('Apakah anda yakin ingin menhapus item ini?')"
                                            class='d-inline' action="{{ url('kategori/' . $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>
                        {{-- <a href="#modalDelete" data-toggle="modal" onclick="$('#modalDelete #formDelete').attr('action', '{{ url('kategori/' . $item->kode) }}')" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                            Hapus
                        </a> --}}
                    </tr>
                    <?php $k++; ?>
                    @endforeach
                  </tbody>
                </table>
                  {{ $kategori->withQueryString()->links() }}
        </div>
        <!-- AKHIR DATA -->
      </main>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </body>
  </html>
      </x-app-layout>
  
      <div class="modal fade" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Yakin akan menghapus data ini?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <form id="formDelete" action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-default" style="border: 1px solid #000000" data-dismiss="modal">Tidak</button>
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>