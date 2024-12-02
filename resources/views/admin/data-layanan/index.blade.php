@extends('admin.layouts.main')

@section('container')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">List Jasa</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4>List Jasa</h4> --}}
                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJasaModal">
                                    <i class="fas fa-wrench"></i> Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jasa</th>
                                            <th>deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jasaLayanans as $jasaLayanan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $jasaLayanan->nama_jasa }}</td>
                                            <td>{{ $jasaLayanan->deskripsi }}</td>
                                            <td>
                                                <a href="#" class="btn btn-secondary">Detail</a>
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


<!-- Modal Tambah Admin -->
<div class="modal fade" id="addJasaModal" tabindex="-1" role="dialog" aria-labelledby="addJasaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJasaModalLabel">Tambah Data Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Nama Jasa</label>
                        <input type="text" name="nama_jasa" class="form-control @error('nama_jasa') is-invalid @enderror" value="{{ old('nama_jasa') }}" required>
                        @error('nama_jasa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Deskripsi</label>
                        <input type="text" name="username" class="form-control @error('deksripsi') is-invalid @enderror" value="{{ old('deskripsi') }}" required>
                        @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
