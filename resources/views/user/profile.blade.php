<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Viary Store</title>

    <!-- Bootstrap core CSS -->
    <link href="/user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/user/assets/css/fontawesome.css">
    <link rel="stylesheet" href="/user/assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="/user/assets/css/owl.css">

  </head>

  <body>

    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
            <a class="navbar-brand" href="{{ route('user.home') }}"><h2>Viary <em>Store</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.home') }}">Home
                    {{-- <span class="sr-only">(current)</span> --}}
                    </a>
                </li> 
                <li class="nav-item {{ Request::is('produk') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.produk') }}">Pembelian</a>
                </li>
                <li class="nav-item {{ Request::is('pemesanan') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.pemesanan') }}">Pemesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
    
                <!-- Cart Icon -->
    
    
                @auth
                    <!-- Display "Hi, [username]" and Profile dropdown when logged in -->
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user ml-1"></i> Hi, {{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if (Auth::user()->hasRole('admin'))
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                        </form>
                    </div>
                    </li>
                @else
                    <!-- Show Login and Register links when not logged in -->
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                    </div>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="#" id="cart-icon">
                    <i class="fa fa-shopping-cart"></i>
                    <span id="cart-count" class="badge badge-danger">{{ session('cart') ? array_sum(session('cart')) : 0 }}</span>
                    </a>
                </li>
                <!-- Sidebar Popup -->
                <div id="cart-sidebar" class="cart-sidebar">
                    <div class="cart-header">
                        <h4>Keranjang saya</h4>
                        <button class="close-btn" onclick="toggleCartSidebar()">&times;</button>
                    </div>
                    <div class="cart-content">
                        <!-- Cart Item -->
                        <div class="cart-item">
                            <img src="https://via.placeholder.com/50" alt="Produk" class="product-img">
                            <div class="product-details">
                                <p class="product-name">Robusta Brazil</p>
                                <p class="product-price">
                                    Rp <span class="unit-price">20.000</span> × 
                                    <span class="quantity-controls">
                                        <button class="btn-minus" onclick="updateQuantity(this, -1)">−</button>
                                        <span class="quantity">3</span>
                                        <button class="btn-plus" onclick="updateQuantity(this, 1)">+</button>
                                    </span> = Rp <span class="total-price">60.000</span>
                                </p>
                            </div>
                        </div>
                </div>
                
                    <!-- Overlay to close sidebar when clicking outside -->
                    <div id="cart-overlay" class="cart-overlay" onclick="toggleCartSidebar()"></div>
                </ul>
            </div>
            </div>
        </nav>
    </header>
    <div>
        <div>
          <div>
            <div class="text-content">
              <h4>Best Offer</h4>
              <h2>New Arrivals On Sale</h2>
            </div>
          </div>
          {{-- <div class="banner-item-02">
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
          </div> --}}
        </div>
      </div>
    
      <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h4>Profil Pengguna</h4>
            </div>
            @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
            
            @elseif(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
              </div>
                
            @endif
            <form action="{{ route('user.updateProfile') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <!-- Tabel Informasi User -->
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Full Name</th>
                                <td>
                                    <input type="text" class="form-control" name="fullname" value="{{ Auth::user()->fullname }}" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>
                                    <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td>
                                    <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone ?? '' }}" placeholder="Isi nomor telepon">
                                </td>
                            </tr>
                        </tbody>
                    </table>
    
                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                    <a href="/" class="btn btn-warning mt-3">Ubah Kata Sandi</a>
                </div>
            </form>
        </div>
    </div>
    
    
    
<script>
        function toggleCartSidebar() {
        const sidebar = document.getElementById('cart-sidebar');
        const overlay = document.getElementById('cart-overlay');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }
    
    document.getElementById('cart-icon').addEventListener('click', function (event) {
        event.preventDefault();
        toggleCartSidebar();
    });
    
    function updateQuantity(button, change) {
            const quantityElement = button.parentNode.querySelector('.quantity');
            let quantity = parseInt(quantityElement.textContent);
            const unitPrice = parseInt(button.closest('.cart-item').querySelector('.unit-price').textContent.replace('.', ''));
            quantity += change;
            if (quantity < 1) quantity = 1; // Minimum jumlah adalah 1
            quantityElement.textContent = quantity;
    
            // Update total harga per item
            const totalPriceElement = button.closest('.cart-item').querySelector('.total-price');
            totalPriceElement.textContent = (unitPrice * quantity).toLocaleString('id-ID');
        }
        // Mengatur agar alert success dan error menghilang dalam 3 detik
    setTimeout(function() {
        // Menghilangkan alert setelah 3 detik
        const alertElements = document.querySelectorAll('.alert');
        alertElements.forEach(function(alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(function() {
                alert.remove();
            }, 500); // Delay tambahan untuk transisi penghilangan
        });
    }, 3000); // 3000 ms = 3 detik
    
</script>
    
    
<style>
    .cart-sidebar {
        position: fixed;
        right: -400px;
        top: 0;
        width: 400px;
        height: 100%;
        background-color: #fff;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        transition: right 0.3s ease;
        z-index: 1050;
        overflow-y: auto;
    }
    
    .cart-sidebar.active {
        right: 0; /* Slide in */
    }
    
    #cart-count {
        position: relative;
        top: 5px; /* Adjust to position badge properly */
        right: 10px; /* Adjust to position badge properly */
        background-color: red;
        color: white;
        font-size: 0.55rem;
        font-weight: bold;
        border-radius: 50%;
        padding: 2px 3px;
        line-height: 1;
    }
    
    .cart-header {
        padding: 15px;
        background-color: #343a40;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #fff;
        cursor: pointer;
    }
    
    .cart-content {
        padding: 15px;
    }
    
    .cart-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
        font-family: Arial, sans-serif;
    }
    
    .product-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }
    
    .product-details {
        flex: 1;
    }
    
    .product-name {
        font-weight: bold;
        margin: 0;
        display: flex
    }
    
    .product-price {
        font-size: 0.9rem;
        color: #555;
        display: flex;
        align-items: center;
    }
    
    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 5px;
        margin: 0 5px;
    }
    
    .quantity-controls button {
        border: none;
        background-color: #000; /* Warna latar belakang hitam */
        color: #fff; /* Warna teks putih */
        width: 20px;
        height: 20px;
        border-radius: 3px;
        font-size: 0.8rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .quantity-controls .quantity {
        font-size: 0.9rem;
        text-align: center;
        width: 20px;
    }
    
</style>
    
    

        <!-- Bootstrap core JavaScript -->
        <script src="/user/vendor/jquery/jquery.min.js"></script>
        <script src="/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    
        <!-- Additional Scripts -->
        <script src="/user/assets/js/custom.js"></script>
        <script src="/user/assets/js/owl.js"></script>
        <script src="/user/assets/js/slick.js"></script>
        <script src="/user/assets/js/isotope.js"></script>
        <script src="/user/assets/js/accordions.js"></script>
    
    
        <script language = "text/Javascript"> 
          cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
          function clearField(t){                   //declaring the array outside of the
          if(! cleared[t.id]){                      // function makes it static and global
              cleared[t.id] = 1;  // you could use true and false, but that's more typing
              t.value='';         // with more chance of typos
              t.style.color='#fff';
              }
          }
        </script>
    
</body>
</html>