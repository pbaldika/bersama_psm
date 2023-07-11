<!-- Brand Logo -->
<a href="{{route('admin.home')}}" class="brand-link">
  <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light">Bersama</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">Alexander Pierce</a>
    </div>
  </div> --}}

  <!-- SidebarSearch Form -->
  <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="{{route('admin.user')}}" class="nav-link">
          <i class="fas fa-users"></i>
          <p>
            Users
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.funding')}}" class="nav-link">
          <i class="fas fa-money-bill"></i>
          <p>
            Fundings
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.project')}}" class="nav-link">
          <i class="fas fa-briefcase"></i>
          <p>
            Projects
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('landing')}}" class="nav-link">
          <i class="fas fa-rocket"></i>
          <p>
            Beranda Bersama
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link">
          <i class="fas fa-sign-out-alt"></i>
          <p>
            Logout
          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->