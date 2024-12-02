@extends('admin.layouts.main')

@section('container')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Tambah Produk</div>
            </div>
          </div>

          <!-- Button Kembali -->
          <div class="mb-3">
            <a href="{{ route('admin.produk') }}" class="btn btn-outline-danger">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>

          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{ $title }}</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('admin.produkstore') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                    <div class="row">

                      <div class="col-md-6">
                        <!-- Kode Produk -->
                        <div class="form-group">
                            <label for="kode_produk">Kode Produk</label>
                            <input type="text" class="form-control @error('kode_produk') is-invalid @enderror" id="kode_produk" name="kode_produk" value="{{ $kodeProduk }}" readonly>
                            @error('kode_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Produk -->
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" autofocus required>
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori Produk -->
                        <div class="form-group">
                          <label for="kategori">Kategori</label>
                          <select class="form-control" name="category_id">
                            @foreach ($categories as $category)
                            @if (old('category_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->nama_kategori }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                
                            @endif
                                
                            @endforeach
                          </select>
                        </div>

                        <!-- Harga Produk -->
                        {{-- <div class="form-group">
                            <label for="harga">Harga Satuan</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" onkeyup="formatRupiah(this)" value="{{ old('harga') }}" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="form-group">
                          <label>Harga Satuan</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                Rp
                              </div>
                            </div>
                            <input type="text" class="form-control currency @error('harga') is-invalid @enderror" id="harga" name="harga" onkeyup="formatRupiah(this)" value="{{ old('harga') }}" required>
                            @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div id="variant-container">
                          <div class="form-group row">
                              <div class="col-md-6">
                                  <label for="size">Variant Produk</label>
                                  <input type="text" class="form-control" name="sizes[]" placeholder="Contoh: S" value="{{old ('size') }}" required>
                              </div>
                              <div class="col-md-6">
                                  <label for="quantity">Stok</label>
                                  <input type="number" class="form-control" name="quantities[]" placeholder="Stok" value="{{ old('quantity') }}" required>
                              </div>
                          </div>
                      </div>
                      <button type="button" class="btn btn-success btn-sm mb-1" onclick="addVariant()">Tambah Ukuran</button>

                      
                      <!-- Foto Produk -->
                      <div class="form-group">
                        <label for="foto_produk">Foto Produk</label>
                        <img class="img-preview img-fluid mb-3 col-sm-6">
                        <input type="file" class="form-control @error('foto_produk') is-invalid @enderror" id="foto_produk" name="foto_produk" onchange="previewImage()" required>
                        @error('foto_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <!-- Keterangan Produk -->
                      <div class="form-group">
                          <label for="keterangan">Keterangan</label>
                          <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                          @error('keterangan')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                  </div>
                      
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                    <a href="{{ route('admin.produk') }}" class="btn btn-danger">Batal</a>
                  </div>
                </form>
                </div>
            </div>
          </div>
        </section>
      </div>

      <script>
        function previewImage() {
            const fileInput = document.querySelector('#foto_produk');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(fileInput.files[0]);

            oFReader.onload = function(OFREvent) {
                imgPreview.src = OFREvent.target.result;
            }
        }


        function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let remainder = split[0].length % 3;
        let rupiah = split[0].substr(0, remainder);
        let thousands = split[0].substr(remainder).match(/\d{3}/gi);

        if (thousands) {
            separator = remainder ? '.' : '';
            rupiah += separator + thousands.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = rupiah;
    }


    function addVariant() {
        const container = document.getElementById('variant-container');
        const newVariant = `
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="sizes[]" placeholder="Contoh: S" required>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="quantities[]" placeholder="Stok" required>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', newVariant);
    }
    </script>
@endsection
