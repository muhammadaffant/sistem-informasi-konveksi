@extends('user.layouts.app')

@section('container')


{{-- <div>
  <div>
    <div>
      <div class="text-content">
        <h4>Best Offer</h4>
        <h2>New Arrivals On Sale</h2>
      </div>
    </div>
    <div class="banner-item-02">
      <div class="text-content">
        <h4>Flash Deals</h4>
        <h2>Get your best products</h2>
      </div>
    </div>
    <div class="banner-item-03">
      <div class="text-content">
        <h4>Last Minute</h4>
        <h2>Grab last minute deals</h2>
      </div>
    </div>
  </div>
</div> --}}

<div class="page-heading products-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>new</h4>
            <h2>Detail Produk</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="container my-5">
    <div class="row">
        <!-- Gambar Produk -->
        <div class="col-md-5">
            <div class="product-gallery">
                <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="{{ $produk->nama_produk }}" class="img-fluid mb-3">
                <div class="product-thumbnails d-flex">
                 
                        <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="Thumbnail" class="img-thumbnail me-2" style="width: 80px; height: 80px;">
                    
                </div>
            </div>
        </div>

        <!-- Detail Produk -->
        <div class="col-md-7">
            <h3 class="product-title">{{ $produk->nama_produk }}</h3>
            {{-- <div class="product-rating mb-2">
                <span class="badge bg-success">5.0</span> (2 Penilaian)
            </div> --}}
            <h4 class="text-danger">{{ $produk->formatrupiah('harga') }}</h4>
            <p class="mb-1">Kategori: <strong>{{ $produk->category->nama_kategori }}</strong></p>
            {{-- <p class="mb-1">Stok: <strong>{{ $produk->stok }}</strong></p> --}}
            {{-- <p class="text-muted">{{ $produk->keterangan }}</p> --}}

        <!-- Pilihan Ukuran -->
        <div class="mt-5">
          <h5>Pilih Ukuran</h5>
          <div class="d-flex flex-wrap">
              @foreach ($produk->variants as $variant)
                  <button class="btn btn-outline-primary me-2 mt-2 size-option" 
                          data-size="{{ $variant->size }}" 
                          data-quantity="{{ $variant->quantity }}">
                      {{ $variant->size }}
                  </button>
              @endforeach
          </div>
      </div>

      <!-- Kuantitas -->
      <div class="mt-3">
          <h5>Kuantitas</h5>
          <div class="d-flex align-items-center">
              <button class="btn btn-outline-secondary" id="decrement-btn" disabled>-</button>
              <input type="number" id="quantity-input" value="1" min="1" class="form-control mx-2 text-center" style="width: 80px;" readonly>
              <button class="btn btn-outline-secondary" id="increment-btn" disabled>+</button>
          </div>
          <small id="stock-info" class="text-muted mt-2 d-block"></small>
      </div>
      <!-- Tombol Aksi -->
      <div class="mt-4">
        <button class="btn btn-warning me-2" onclick="addToCart({{ $produk->id }})">
            <i class="fa fa-cart-plus"></i> Masukkan Keranjang
        </button>
        <a href="/" class="btn btn-primary">
            <i class="fa fa-shopping-bag"></i> Beli Sekarang
        </a>
    </div>

            <!-- Informasi Pengiriman -->
            {{-- <div class="mt-4">
                <p class="mb-1"><i class="fa fa-truck"></i> Gratis Ongkir ke <strong>Jakarta Pusat</strong></p>
                <p class="mb-1"><i class="fa fa-sync-alt"></i> Bebas Pengembalian</p>
                <p class="mb-1"><i class="fa fa-check-circle"></i> Garansi Shopee</p>
            </div> --}}
        </div>
    </div>

    <!-- Deskripsi Produk -->
    <div class="mt-5">
        <h5>Deskripsi Produk</h5>
        <hr>
        <p>{{ $produk->keterangan }}</p>
    </div>
</div>

<style>
  .product-gallery img {
    border: 1px solid #ddd;
    border-radius: 8px;
    max-height: 400px;
    object-fit: cover;
}

.product-thumbnails img {
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
}

.product-thumbnails img:hover {
    border: 2px solid #007bff;
}

.product-title {
    font-weight: bold;
}

</style>

@endsection

<script>
      document.addEventListener('DOMContentLoaded', () => {
        let selectedStock = 0;

        // Pilih ukuran
        document.querySelectorAll('.size-option').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.size-option').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                selectedStock = parseInt(button.getAttribute('data-quantity'), 10);

                // Update kuantitas dan info stok
                document.getElementById('quantity-input').value = 1;
                document.getElementById('quantity-input').max = selectedStock;
                document.getElementById('decrement-btn').disabled = false;
                document.getElementById('increment-btn').disabled = selectedStock <= 1;
                document.getElementById('stock-info').textContent = `Tersisa ${selectedStock} buah`;
            });
        });

        // Decrement button
        document.getElementById('decrement-btn').addEventListener('click', () => {
            const quantityInput = document.getElementById('quantity-input');
            const currentValue = parseInt(quantityInput.value, 10);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        // Increment button
        document.getElementById('increment-btn').addEventListener('click', () => {
            const quantityInput = document.getElementById('quantity-input');
            const currentValue = parseInt(quantityInput.value, 10);
            const maxStock = parseInt(quantityInput.max, 10);
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
            }
        });
    });
    
    function addToCart(productId) {
        fetch(`/add-to-cart/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('cart-count').textContent = data.cartCount;
        })
        .catch(error => console.error('Error:', error));
    }
</script>
