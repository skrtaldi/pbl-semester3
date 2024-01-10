<x-app-layout>
    <body class="bg-light">
        <main class="container p-5">
            <a href='{{ url('supplier') }}' class="btn btn-secondary btn-md mt-2"> < Kembali</a>
            <div class="my-3 p-3 bg-body shadow-sm" style="border-radius: 20px;">
                <!-- FORM PENCARIAN -->

                <!-- Tabel Vertikal -->
                @foreach ($supplier as $supp)
                    <table class="table table-striped">
                        <tbody>
                            <tr class="text-center">
                                <th class="col-md-2">Kode</th>
                                <td>{{ $supp->kode }}</td>
                            </tr>
                            <tr class="text-center">
                                <th class="col-md-2">Nama</th>
                                <td>{{ $supp->nama }}</td>
                            </tr>
                            <tr class="text-center">
                                <th class="col-md-2">Alamat</th>
                                <td>{{ $supp->alamat }}</td>
                            </tr>
                            <tr class="text-center">
                                <th class="col-md-2">Nomor HP</th>
                                <td>
                                    <a href="https://wa.me/{{ '62'.substr($supp->nomor, 1) }}" target="_blank">
                                        {{ $supp->nomor }}
                                    </a>
                                </td>
                            </tr>                                                  
                            <tr class="text-center">
                                <th class="col-md-2">Tentang</th>
                                <td>
                                    {{ $supp->penjelasan }}
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    <br> <!-- Spasi antar supplier -->
                @endforeach
            </div>
        </main>
    </body>
</html>
</x-app-layout>
