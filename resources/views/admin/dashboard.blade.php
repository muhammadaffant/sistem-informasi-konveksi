@extends('admin.layouts.main')

@section('container')

<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-cart-plus"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Orderan</h4>
              </div>
              <div class="card-body">
                10
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-lg-2 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="fas fa-clock"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Belum Diproses</h4>
              </div>
              <div class="card-body">
                42
              </div>
            </div>
          </div>
        </div> --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-cut"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>pemesanan produk</h4>
              </div>
              <div class="card-body">
                1,201
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-truck"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Siap Dikirm</h4>
              </div>
              <div class="card-body">
                42
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-check"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Orderan Selesai</h4>
              </div>
              <div class="card-body">
                47
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-dark">
              <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Stok Produk</h4>
              </div>
              <div class="card-body">
                {{ $produkCount }}
              </div>
            </div>
          </div>
        </div>                  
      </div> --}}
      {{-- <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Statistics</h4>
              <div class="card-header-action">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary">Week</a>
                  <a href="#" class="btn">Month</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <canvas id="myChart" height="182"></canvas>
              <div class="statistic-details mt-sm-4">
                <div class="statistic-details-item">
                  <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</span>
                  <div class="detail-value">$243</div>
                  <div class="detail-name">Today's Sales</div>
                </div>
                <div class="statistic-details-item">
                  <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</span>
                  <div class="detail-value">$2,902</div>
                  <div class="detail-name">This Week's Sales</div>
                </div>
                <div class="statistic-details-item">
                  <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</span>
                  <div class="detail-value">$12,821</div>
                  <div class="detail-name">This Month's Sales</div>
                </div>
                <div class="statistic-details-item">
                  <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</span>
                  <div class="detail-value">$92,142</div>
                  <div class="detail-name">This Year's Sales</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Recent Activities</h4>
            </div>
            <div class="card-body">             
              <ul class="list-unstyled list-unstyled-border">
                <li class="media">
                  <img class="mr-3 rounded-circle" width="50" src="/admin/assets/img/avatar/avatar-1.png" alt="avatar">
                  <div class="media-body">
                    <div class="float-right text-primary">Now</div>
                    <div class="media-title">Farhan A Mujib</div>
                    <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                  </div>
                </li>
                <li class="media">
                  <img class="mr-3 rounded-circle" width="50" src="/admin/assets/img/avatar/avatar-2.png" alt="avatar">
                  <div class="media-body">
                    <div class="float-right">12m</div>
                    <div class="media-title">Ujang Maman</div>
                    <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                  </div>
                </li>
                <li class="media">
                  <img class="mr-3 rounded-circle" width="50" src="/admin/assets/img/avatar/avatar-3.png" alt="avatar">
                  <div class="media-body">
                    <div class="float-right">17m</div>
                    <div class="media-title">Rizal Fakhri</div>
                    <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                  </div>
                </li>
                <li class="media">
                  <img class="mr-3 rounded-circle" width="50" src="/admin/assets/img/avatar/avatar-4.png" alt="avatar">
                  <div class="media-body">
                    <div class="float-right">21m</div>
                    <div class="media-title">Alfa Zulkarnain</div>
                    <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                  </div>
                </li>
              </ul>
              <div class="text-center pt-1 pb-1">
                <a href="#" class="btn btn-primary btn-lg btn-round">
                  View All
                </a>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    </section>
  </div>

    <!-- SweetAlert berhasil login -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: false,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });

        // Kondisi login berhasil
        @if(session('login_success'))
          Toast.fire({
            icon: "success",
            title: "Login berhasil"
          });
        @endif
      });
    </script>
@endsection