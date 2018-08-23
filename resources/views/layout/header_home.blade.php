<header class="main-header">
  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}"><i><img src="{{ url('assets/image/logo.png') }}" width="30" height="30"> </i> IKI SOUNDSYSTEM</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/portofolio') }}"><i class="fa fa-file-picture-o"></i> Portofolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/package') }}"><i class="fa fa-book"></i> Package</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/schedule') }}"><i class="fa fa-calendar"></i> Schedule</a>
          </li>
          <li class="nav-item" {{ $isLogin }} >
            <a class="nav-link" href="{{ url('/booking') }}"><i class="fa fa-calendar-check-o"></i> Booking </a>
          </li>
          <li class="nav-item" {{ $isLogout }}>
            <a class="nav-link" href="{{ url('/login') }}"><i class="fa fa-fw fa-sign-in"></i> Login</a>  
          </li>

          <li class="nav-item dropdown" {{ $isLogin }}>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-circle-o"></i> {{ $username }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a {{ $admin_area }} class="dropdown-item" href="{{ url('/dashboard') }}"><i class=">fa fa-fw fa fa-eye"></i> Admin Area</a>
              <a {{ $crew_salary }} class="dropdown-item" href="{{ url('/crewSalary') }}"><i class=">fa fa-fw fa fa-credit-card"></i> Crew Salary</a>
              <a {{ $statusBooking }} class="dropdown-item" href="{{ url('/statusBooking') }}"><i class=">fa fa-fw fa fa-credit-card"></i> Status Booking</a>
              <a class="dropdown-item" href="{{ url('/myProfile') }}"><i class="fa fa-fw fa-user"></i> My Profile</a>
              <a class="dropdown-item" href="{{ url('/auth/logout') }}"><i class="fa fa-fw fa-sign-out"></i> Sign Out</a> 
            </div>
          </li>
        
        </ul>

      </div>
    </div>
  </nav>
</header>