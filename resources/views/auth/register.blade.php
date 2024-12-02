<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="/admin/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/admin/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/admin/assets/modules/jquery-selectric/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/admin/assets/css/style.css">
  <link rel="stylesheet" href="/admin/assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('register.save') }}">
                  @csrf
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="fullname">Fullname</label>
                      <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" autofocus value="{{ old('fullname') }}">
                      @error('fullname')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="username">Username</label>
                      <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}">
                      @error('username')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                <div class="row">
                  <div class="form-group col-6">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group col-6">
                    <label for="phone">Phone</label>
                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" pattern="[0-9]+">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password">Password</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                      @error('password')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="password2">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password">
                      @error('confirm_password')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input @error('agree') is-invalid @enderror" id="agree">
                      <label class="custom-control-label" for="agree">Saya setuju dengan syarat dan ketentuan</label>
                      @error('agree')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" id="registerBtn" class="btn btn-dark btn-lg btn-block" disabled>
                        Register
                      </button>                      
                  </div>
                </form>
                <div class="mt-5 text-muted text-center">
                    Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                </div>
              </div>
            </div>
            <div class="simple-footer" id="copyright">
              Copyright &copy; Affan <script>document.write(new Date().getFullYear());</script>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="/admin/assets/modules/jquery.min.js"></script>
  <script src="/admin/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="/admin/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  {{-- <script>
    document.getElementById('country').addEventListener('change', function () {
      const country = this.value;
  
      // Pastikan ada negara yang dipilih
      if (country !== '') {
        // AJAX request untuk mendapatkan provinsi berdasarkan negara yang dipilih
        fetch(`/get-provinces?country=${country}`)
          .then(response => response.json())
          .then(data => {
            const provinceSelect = document.getElementById('province');
            provinceSelect.innerHTML = '<option value="">-- Select Province --</option>';
  
            // Loop data provinsi dan tambahkan sebagai option
            data.forEach(province => {
              const option = document.createElement('option');
              option.value = province;
              option.text = province;
              provinceSelect.appendChild(option);
            });
          })
          .catch(error => console.error('Error fetching provinces:', error));
      } else {
        // Reset province select jika tidak ada negara yang dipilih
        const provinceSelect = document.getElementById('province');
        provinceSelect.innerHTML = '<option value="">Select a country first</option>';
      }
    });
  </script> --}}
  
  <script>
    document.getElementById('agree').addEventListener('change', function () {
      const registerBtn = document.getElementById('registerBtn');
  
      // Jika checkbox dicentang, enable tombol, jika tidak, disable tombol
      if (this.checked) {
        registerBtn.removeAttribute('disabled');
      } else {
        registerBtn.setAttribute('disabled', 'disabled');
      }
    });
  </script>
  
</body>
</html>
