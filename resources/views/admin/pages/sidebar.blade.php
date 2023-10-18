<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
          <a href="#" class="d-block">Protect the list</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            {{-- <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> --}}
            <ul class="nav nav-treeview">
                    <li class="nav-item btn-primary">
                        <a href="{{ route('admin.dashboarditems.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.dashboarditems.index' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Darhboard</p>
                        </a>
                    </li>
              <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.dashboard.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.category.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.category.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.product.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.product.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.formblog.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.formblog.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Formblog</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.slide.index') }}" class="nav-link {{ request()->route()->getName() === 'admin.slide.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slides</p>
                </a>
              </li>

            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
