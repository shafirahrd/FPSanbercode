<nav class="main-header navbar navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav flex-row">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link"></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-6">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
          <div class="info" data-toggle="dropdown" style="cursor: pointer">
            @if (Session::has('name'))
              <a class="d-block">{{Session::get('name')}}</a>
            @else
              <a class="d-block">no user</a>  
            @endif
          </div>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right position-absolute">
          @if (Session::has('name'))
          <div class="dropdown-divider"></div>
          <a href="/logout" class="dropdown-item">
            <i class="far fa-circle nav-icon"></i>
            <p>Log out</p>
          </a>
          <div class="dropdown-divider"></div>
          @else
            <div class="dropdown-divider"></div>
            <a href="/login" class="dropdown-item">
              <i class="far fa-circle nav-icon"></i><span style="margin-left: 10px">Log in</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="/registr" class="dropdown-item">
              <i class="far fa-circle nav-icon"></i><span style="margin-left: 10px">Register</span>  
            </a>
            <div class="dropdown-divider"></div>
          @endif
        </div>
      </li>
    </ul>
  </nav>