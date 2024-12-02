@extends('admin.layouts.main')

@section('container')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">List Member</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4>List produk</h4> --}}
                            <div class="card-header-action">
                              {{-- <a href="/" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Input Pemesanan
                            </a> --}}
                          </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped text-center" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Telepon</th>
                                            <th>Alamat</th>
                                            <th>kategori</th>
                                            <th>Keperluan</th>
                                            <th>Ukuran</th>
                                            <th>Jumlah</th>
                                            <th>Gambar</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pemesanans as $pemesanan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pemesanan->nama }}</td>
                                            <td>{{ $pemesanan->telepon }}</td>
                                            <td>{{ $pemesanan->alamat }}</td>
                                            <td>{{ $pemesanan->category->nama_kategori }}</td>
                                            {{-- <td>
                                                @foreach($produk->variants as $variant)
                                                    <p>{{ $variant->size }}: {{ $variant->quantity }}</p>
                                                @endforeach
                                            </td> --}}
                                            <td>{{ $pemesanan->keperluan }}</td>
                                            <td>{{ $pemesanan->ukuran }}</td>
                                            <td>{{ $pemesanan->jumlah }}</td>
                                            {{-- <td>{{ $pemesanan->gambar }}</td> --}}
                                            <td>
                                              <img src="{{ asset('storage/' . $pemesanan->gambar) }}" alt="{{ $pemesanan->nama }}" class="img-fluid" width="100">
                                          </td> 
                                            <td>{{ $pemesanan->keterangan }}</td>
                                            <td>
                                                <a href="#" class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i>Lihat</a>
                                                <a href="" class="btn btn-icon icon-left btn-warning"><i class="fas fa-edit"></i>Edit</a>
                                                <form id="deleteForm" action="" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-icon icon-left btn-danger" onclick="confirmDelete">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true,
    });
</script>
@endif

{{-- <script>
    function confirmDelete(produkId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna menekan 'Ya', submit form
                document.getElementById('deleteForm' + produkId).submit();
            }
        });
    }
</script> --}}

@endsection
