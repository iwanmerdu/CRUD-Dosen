<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Belajar Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">BIODATA DOSEN</h3>
                    <h5 class="text-center"><a href="">BELAJAR LARAVEL</a></h5>         
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('dosen.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">FOTO</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">NIDN</th>
                                <th scope="col">JENIS KELAMIN</th>
                                <th scope="col">ALAMAT</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                                <!-- CODE DISINI UNTUK TAMPILKAN DATA DARI TABEL DENGAN FORELSE-->
                                @forelse ($dosen as $ds)
                                <tr>
                                    <td class="text-center"> 
                                        <img src="{{ asset('/storage/gambar/'.$ds->foto) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>
                                    {{ $ds->nama }}
                                    </td>
                                    <td>
                                    {{ $ds->nidn }}
                                    </td>
                                    <td>
                                    {{ $ds->jns_kelamin }}
                                    </td>
                                    <td>
                                    {{ $ds->alamat }}
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('dosen.destroy', $ds->id) }}" method="POST">
                                        <a href="{{ route('dosen.show', $ds->id) }}" class="btn btn-sm btn-dark">SHOW</a> 
                                        <a href="{{ route('dosen.edit', $ds->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>

                                </tr>
                                @empty
<div class="alert alert-danger">Data belum ada.</div>
@endforelse
                            </tbody>
                          </table>  
                         
						  <!-- Code disini untuk paginasi halaman/link -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- kode javascript untuk munculkan pesan -->
    <script>
        //message with toastr
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!'); 
        @endif
    </script>



</body>
</html>
