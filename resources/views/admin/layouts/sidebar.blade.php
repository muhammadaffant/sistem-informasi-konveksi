<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="/">VIMS</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="/">VMS</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      
      <li class="dropdown {{ $active == 'Dashboard' ? 'active' : '' }}">
      @if (Auth::user()->hasRole('admin'))
            
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
        
      @elseif (Auth::user()->hasRole('owner'))
        <a href="{{ route('owner.dashboard') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
      @endif
      </li>

      <li class="menu-header">Menu</li>
      @if (Auth::user()->hasRole('owner'))
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i> <span>Data Master</span></a>
        <ul class="dropdown-menu custom-dropdown">
          <li><a class="nav-link" href=""><i class="fas fa-boxes"></i>Laporan Keuangan</a></li>
          {{-- <li><a class="nav-link" href=""><i class="fas fa-cut"></i>Rencana Produksi</a></li> --}}
          <li><a class="nav-link" href=""><i class="fas fa-clipboard-list"></i>Orderan Selesai</a></li>
        </ul>
      </li>
      @endif

      <li class="dropdown {{ $active == 'Stok Produk' || $active == 'Kategori'  ? 'active' : '' }}">
        @if (Auth::user()->hasRole('admin'))
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clipboard-list"></i> <span>Produk</span></a>
        <ul class="dropdown-menu custom-dropdown">
          <li class="{{ $active == 'Stok Produk' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.produk') }}"><i class="fas fa-boxes"></i>Stok Produk</a></li>
          <li class="{{ $active == 'Kategori' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.category') }}"><i class="fas fa-th-large"></i>Kategori</a></li>
          {{-- <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
          <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li> --}}
        </ul>
      </li>

      <li class="dropdown {{ $active == 'Pemesanan' ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-large"></i> <span>Pemesanan Masuk</span></a>
        <ul class="dropdown-menu custom-dropdown">
          <li class="{{ $active == 'Pemesanan' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pemesanan') }}"><i class="fas fa-eye"></i>Lihat Pemesanan</a></li>
        </ul>
      </li>

      <li class="dropdown {{ $active == 'Input Order' || $active == ''  ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-cart-plus"></i> <span>Orderan</span></a>
        <ul class="dropdown-menu custom-dropdown">
          <li><a class="nav-link" href=""><i class="fas fa-eye"></i>Lihat Orderan</a></li>
          <li class="{{ $active == 'Input Order' ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.input.order') }}"><i class="fas fa-plus"></i>Input Orderan</a></li>

          <li><a class="nav-link" href=""><i class="fas fa-check"></i>Orderan Selesai</a></li>
        </ul>
      </li>
      @endif

      <li class="dropdown {{ $active == 'Jasa Layanan' ? 'active' : '' }}">
        @if(Auth::user()->hasRole('admin'))
            <a href="/admin/jasalayanan"><i class="fas fa-wrench"></i> <span>Data layanan</span></a>
        {{-- @endif --}}
      
      <li class="dropdown {{ $active == 'Report' ? 'active' : '' }}">
        {{-- @if(Auth::user()->hasRole('admin')) --}}
            <a href="/admin/report"><i class="fas fa-chart-bar"></i> <span>Report</span></a>
        @endif

    @if(Auth::user()->hasRole('owner'))
      <li class="menu-header">Akun</li>
    @elseif(Auth::user()->hasRole('admin'))  
      <li class="menu-header">Management User</li>
    @endif

      <li class="dropdown {{ $active == 'Profile' ? 'active' : '' }}">
    @if(Auth::user()->hasRole('owner'))
        <a href="{{ route('owner.profile') }}"><i class="fas fa-user"></i> <span>Profile</span></a>
    @endif

    @if(Auth::user()->hasRole('admin'))
        <a href="{{ route('admin.profile') }}"><i class="fas fa-user"></i> <span>Profile</span></a>
    @endif
      </li>


    @if (Auth::user()->hasRole('owner'))
      <li class="menu-header">DaTa Karyawan</li>
      <li class="dropdown {{ $active == 'Karyawan' ? 'active' : '' }}">
        <a href=""><i class="fas fa-users"></i> <span>Data Karyawan</span></a>
        
    @endif
      <li class="dropdown {{ $active == 'List Owner' || $active == 'List Admin' || $active == 'List Member' ? 'active' : '' }}">
    @if(Auth::user()->hasRole('admin'))
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span>User</span></a>
        <ul class="dropdown-menu custom-dropdown">
          {{-- <li class="{{ $active == 'Profile' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.profile') }}">
              <i class="fas fa-user"></i>Profile
            </a>
          </li> --}}
          <li class="{{ $active == 'List Owner' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.listowner') }}">
              <i class="fas fa-crown"></i>Owner
            </a>
          </li>
          <li class="{{ $active == 'List Admin' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.listadmin') }}">
              <i class="fas fa-users-cog"></i>Admin
            </a>
          </li>
          <li class="{{ $active == 'List Member' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.listuser') }}">
              <i class="fas fa-users"></i>Member
            </a>
          </li>
        </ul>
      </li>
    @endif
    </ul>
    

</aside>

  <div class="mb-4 p-3 hide-sidebar-mini" style="margin-top: 350px">
    <a href="{{ route('logout') }}" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
       class="btn btn-outline-danger btn-lg btn-block btn-icon-split">
      <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
    </a>
  
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>


  {{-- css item list --}}
<style>
  .custom-dropdown li {
  margin-left: -40px; /* Geser 10px ke kiri */
  }

</style>