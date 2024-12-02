<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="/admin/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/admin/assets/modules/fontawesome/css/all.min.css">
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/admin/assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/admin/assets/css/style.css">
  <link rel="stylesheet" href="/admin/assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="/admin/assets/img/avatar/avatar-1.png" alt="logo" width="100" class="shadow-light rounded-circle">
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
            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
              <div class="text-muted ml-4">
                <a href="{{ route('resend.verify.form') }}">Kirim Ulang Link Verifikasi</a>
              </div>

              <div class="card-body">
                <form method="POST" action="{{ route('login.action') }}" class="needs-validation" novalidate="">
					@csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="email" autofocus>
                    @error('email')
                              <div class="invalid-feedback">
                      {{-- Please fill in your email --}}
                                  {{ $message }}
                              </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                    <div class="float-right">
                        <a href="{{ route('forgot.password') }}" class="text-small">
                          Lupa Password?
                        </a>
                    </div>
                  </div>
					  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
            @error('password')
                
					  <div class="invalid-feedback">
						  {{ $message }}
						</div>
            @enderror
					</div>
					

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-dark btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                  <div class="mt-5 text-muted text-center">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
                  </div>
                </form>
                {{-- <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Login With Social</div>
                </div>
                <div class="row sm-gutters">
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-facebook">
                      <span class="fab fa-facebook"></span> Facebook
                    </a>
                  </div>
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-twitter">
                      <span class="fab fa-twitter"></span> Twitter
                    </a>                                
                  </div>
                </div> --}}

              </div>
            </div>

            <div class="simple-footer" id="copyright">
              Copyright &copy; Affan
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="/admin/assets/modules/jquery.min.js"></script>
  <script src="/admin/assets/modules/popper.js"></script>
  <script src="/admin/assets/modules/tooltip.js"></script>
  <script src="/admin/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="/admin/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="/admin/assets/modules/moment.min.js"></script>
  <script src="/admin/assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="/admin/assets/js/scripts.js"></script>
  <script src="/admin/assets/js/custom.js"></script>

  <script>
    document.getElementById("copyright").innerHTML += new Date().getFullYear();
</script>

<script>
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


</body>
</html>