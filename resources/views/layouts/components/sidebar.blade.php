<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="light">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="#" class="brand-link">
        <!--begin::Brand Image-->
        <img
          src="../../dist/assets/img/logo.png"
          alt="AdminLTE Logo"
          class="brand-image opacity-75 shadow"
        />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-bold" style="font-family: 'Poppins', sans-serif;">ProjectUAS</span>
        <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(auth()->user()->hasRole('manager') || auth()->user()->hasRole('developer'))
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-database"></i>
              <p>
                Master Data
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('barang.index')}}" class="nav-link">
                  <i class="nav-icon bi bi-box"></i>
                <p>Barang</p>
              </a>
              </li>
              <li class="nav-item">
                <a href="{{route('mekanik.index')}}" class="nav-link">
                    <i class="nav-icon bi bi-person-gear"></i>
                  <p>Mekanik</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('jasa.index')}}" class="nav-link">
                    <i class="nav-icon bi bi-wrench"></i>
                  <p>Jasa</p>
                </a>
              </li>
            </ul>
          </li>
         @endif
          <li class="nav-item">
            <a href="{{route('pelanggan.index')}}" class="nav-link">
                <i class="nav-icon bi bi-people"></i>
              <p>Pelanggan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('kendaraan.index')}}" class="nav-link">
                <i class="nav-icon bi bi-car-front"></i>
              <p>Kendaraan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('servis.index')}}" class="nav-link">
                <i class="nav-icon bi bi-tools"></i>
              <p>Servis</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('transaksi.index')}}" class="nav-link">
              <i class="nav-icon bi bi-cart-check"></i>
              <p>Transaksi</p>
            </a>
          </li>
          @if (auth()->user()->hasRole('manager') || auth()->user()->hasRole('developer'))
          <li class="nav-item">
            <a href="{{route('garansi.index')}}" class="nav-link">
                <i class="nav-icon bi bi-shield-check"></i>
              <p>Garansi</p>
            </a>
          </li>
          @endif
          @if (auth()->user()->hasRole('manager') || auth()->user()->hasRole('developer'))
          <li class="nav-header">SETTINGS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-box-arrow-in-right"></i>
              <p>
                Auth
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link">
                   <i class="nav-icon bi bi-person"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link">
                    <i class="nav-icon bi bi-people"></i>
                  <p>Role</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>
  <!--end::Sidebar-->
