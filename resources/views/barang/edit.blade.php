@extends('layouts.template')

@section('content')

{{-- @if($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $errors)
                    <li>{{ $errors }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif --}}
<!-- START FORM -->
<form action='{{ url('admin/'.$data->kode) }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{ url('admin') }}' class="btn btn-secondary btn-sm"> < Kembali</a>
        <div class="mb-3 row">
            <label for="kode" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
                {{ $data->kode }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{ old('nama', $data->nama) }}" id="nama">
                @if (count($errors) > 0)
                    <div style="width:auto; color:#dc4c64; margin-top:0.25rem;">
                    {{ $errors->first('nama') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jumlah' value="{{ old('jumlah', $data->jumlah) }}" id="jumlah">
                @if (count($errors) > 0)
                    <div style="width:auto; color:#dc4c64; margin-top:0.25rem;">
                    {{ $errors->first('jumlah') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='harga' value="{{ old('harga', $data->harga) }}" id="harga">
                @if (count($errors) > 0)
                    <div style="width:auto; color:#dc4c64; margin-top:0.25rem;">
                    {{ $errors->first('harga') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='supplier' value="{{ old('supplier', $data->supplier) }}" id="supplier">
                @if (count($errors) > 0)
                    <div style="width:auto; color:#dc4c64; margin-top:0.25rem;">
                    {{ $errors->first('supplier') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="supplier" class="col-sm-2 col-form-label">Min Limit</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='minLimit' value="{{ old('minLimit', $data->minLimit) }}" id="minLimit">
                @if (count($errors) > 0)
                    <div style="width:auto; color:#dc4c64; margin-top:0.25rem;">
                    {{ $errors->first('minLimit') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="supplier" class="col-sm-2 col-form-label">Max Limit</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='maxLimit' value="{{ old('maxLimit', $data->maxLimit) }}" id="maxlimit">
                @if (count($errors) > 0)
                    <div style="width:auto; color:#dc4c64; margin-top:0.25rem;">
                    {{ $errors->first('maxLimit') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
                <select name="kategori_id" class="form-control">
                    <option value="" class="text-center">--- Pilih ---</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}" class="text-center" {{ old('kategori_id', $data->kategori_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @if (count($errors) > 0)
                    <div style="width:auto; color:#dc4c64; margin-top:0.25rem;">
                    {{ $errors->first('kategori_id') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary mt-3" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
    <!-- AKHIR FORM -->
@endsection