@extends('user.layouts.app')

@section('container')


    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              {{-- <h4>new</h4> --}}
              <h3>Produk</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb custom-breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="filters">
              <ul>
                  <li class="active" data-filter="*">All Products</li>
                  <li data-filter=".des">Kaos</li>
                  <li data-filter=".dev">Jaket</li>
                  <li data-filter=".gra">Hodie</li>
              </ul>
            </div>
          </div>
          <div class="col-md-12">
            <div class="filters-content">
              <div class="row grid">
                @foreach ($produks as $produk)
                <div class="col-lg-4 col-md-4 all des">
                  <div class="product-item">
                    <a href="#"><img src="{{ asset('storage/' . $produk->foto_produk) }}" alt=""></a>
                    <div class="down-content">
                      <a href="{{ route('produk.show', $produk->id) }}"><h4>{{ $produk->nama_produk }}</h4></a>
                      <h6>{{ $produk->formatrupiah('harga') }}</h6>
                      <p>{{ $produk->keterangan }}</p>
                      <div class="cart-button">
                        <button onclick="addToCart({{ $produk->id }})" class="btn btn-primary">
                          <i class="fa fa-cart-plus"></i>
                        </button>
                      </div>
                      <span>Detail</span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          
          <div class="col-md-12">
            <ul class="pages">
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    

    <script>
        function addToCart(productId) {
        fetch(`/add-to-cart/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token for security
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update the cart count in the navbar
            document.getElementById('cart-count').textContent = data.cartCount;
        })
        .catch(error => console.error('Error:', error));
    }
    
    </script>

@endsection

