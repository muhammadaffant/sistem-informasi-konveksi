@extends('user.layouts.app')

@section('container')
    
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              {{-- <h4>new</h4> --}}
              <h3>Pemesanan</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb custom-breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    {{-- Form Pemesanan --}}
    <div class="form-section py-5">
        <div class="container">
          <div class="section-heading">
            <h2>Form Pemesanan</h2>
          </div>
          <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <!-- Nama Lengkap -->
              <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama lengkap">
              </div>

              <!-- Nomor Telepon/Wa -->
              <div class="col-md-6 mb-3">
                <label for="telepon" class="form-label">Nomor Telepon/WA</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required placeholder="Masukkan nomor telepon/WA">
              </div>

              <!-- Alamat Lengkap -->
              <div class="col-md-12 mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required placeholder="Masukkan alamat lengkap"></textarea>
              </div>

              <!-- Pilih Produk -->
              <div class="col-md-6 mb-3">
                <label for="produk" class="form-label">Kategori</label>
                <select class="form-control" id="kategori" name="kategori" required>
                  <option value="" disabled selected>-- Kategori --</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
              @endforeach
                </select>
              </div>

              <!-- Keperluan Produk -->
              <div class="col-md-6 mb-3">
                <label for="keperluan" class="form-label">Keperluan Produk</label>
                <input type="text" class="form-control" id="keperluan" name="keperluan" required placeholder="Masukkan keperluan produk">
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-label">Ukuran dan Jumlah</label>
                <div id="size-container">
                  <div class="row mb-2">
                    <div class="col-md-6">
                      <select class="form-control" name="sizes[0][size]" required>
                        <option value="" disabled selected>-- Pilih Ukuran --</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <input type="number" class="form-control" name="sizes[0][quantity]" required placeholder="Jumlah">
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-success" onclick="addSize()">+</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Gambar Desain -->
              <div class="col-md-12 mb-3">
                <label for="gambar" class="form-label">Gambar Desain</label>
                <input type="file" class="form-control" id="gambar" name="gambar" required>
              </div>

              <!-- Keterangan -->
              <div class="col-md-12 mb-3">
                <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan tambahan"></textarea>
              </div>

              <!-- Submit Button -->
              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
              </div>
            </div>
          </form>
        </div>  
    </div>

    <script>
        let sizeIndex = 1;
      
        function addSize() {
          const container = document.getElementById('size-container');
          const row = document.createElement('div');
          row.className = 'row mb-2';
      
          row.innerHTML = `
            <div class="col-md-6">
              <select class="form-control" name="sizes[${sizeIndex}][size]" required>
                <option value="" disabled selected>-- Pilih Ukuran --</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
              </select>
            </div>
            <div class="col-md-4">
              <input type="number" class="form-control" name="sizes[${sizeIndex}][quantity]" required placeholder="Jumlah">
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-danger" onclick="removeSize(this)">-</button>
            </div>
          `;
      
          container.appendChild(row);
          sizeIndex++;
        }
      
        function removeSize(button) {
          button.closest('.row').remove();
        }
      </script>

@endsection
