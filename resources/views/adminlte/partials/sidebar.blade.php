<aside class="main-sidebar sidebar-dark-info elevation-4" style="background-color: #008b8b;">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src=" {{ asset('adminlte/dist/img/sanbercode.jpg') }}"
           alt="Sanbercode"
           class="brand-image img-circle elevation-3"/>
      <span class="brand-text" style="padding: 10px; color: white;">Final Project</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar"><br>
      <!-- Sidebar user (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @if (Session::has('name'))
            <a href="/user/{{Session::get('id')}}" class="d-block">{{Session::get('name')}}</a>
          @else
            <a class="d-block">Anonymous</a>  
          @endif
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="/question" class="nav-link" style="color: white;">
                <i class="fa fa-fire nav-icon" style="color: #FFAE42"></i>
                <p>Popular</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/question" class="nav-link" style="color: white;">
                <i class="fa fa-question nav-icon" style="color: #FFAE42"></i>
                <p>Recent</p>
              </a>
            </li>  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      <hr>
      <!-- Tags -->
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link" style="color: white;">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Popular Tags
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 20px;">

              <li class="nav-item">
                <a href="/" class="nav-link" style="color: red;">
                  <i class="fas fa-podcast nav-icon"></i>
                  <p>Tag1</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/" class="nav-link" style="color: orange;">
                  <i class="fas fa-podcast nav-icon"></i>
                  <p>Tag2</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/" class="nav-link" style="color: yellow;">
                  <i class="fas fa-podcast nav-icon"></i>
                  <p>Tag3</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/" class="nav-link" style="color: green;">
                  <i class="fas fa-podcast nav-icon"></i>
                  <p>Tag4</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/" class="nav-link" style="color: blue;">
                  <i class="fas fa-podcast nav-icon"></i>
                  <p>Tag5</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/" class="nav-link" style="color: white;">
                  <i class="fas fa-podcast nav-icon"></i>
                  <p>Tag6</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/" class="nav-link" style="color: purple;">
                  <i class="fas fa-podcast nav-icon"></i>
                  <p>Tag7</p>
                </a>
              </li>

            </ul>
        </li>
      </ul>
    </div>
    <!-- /.sidebar -->
  </aside>

  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>