      <ul class="sidebar navbar-nav">
        <li class="nav-item {{ (url()->current() == route('admin.home')) ? 'active' : ''  }}">
          <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item {{ (url()->current() == url('/admin/home/article')) ? 'active' : '' }}">
          <a class="nav-link" href=" {{ route('admin.home', ['table' => 'article']) }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Article</span></a>
        </li>
        <li class="nav-item {{ (url()->current() == url('/admin/home/category')) ? 'active' : '' }}">
          <a class="nav-link" href=" {{ route('admin.home', ['table' => 'category']) }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Category</span></a>
        </li>
      </ul>