
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
      
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ Request::segment(1) === 'dashboard' ? 'active' : '' }}" ><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="{{ Request::segment(1) === 'project' ? 'active' : '' }}" ><a href="{{ url('/admin/portofolio') }}"><i class="fa fa-book"></i> <span>Portofolio</span></a></li>
        <li class="{{ Request::segment(1) === 'project' ? 'active' : '' }}" ><a href="{{ url('/admin/package') }}"><i class="fa fa-book"></i> <span>Package</span></a></li>
        <li class="{{ Request::segment(1) === 'booking' ? 'active' : '' }}" ><a href="{{ url('/admin/booking') }}"><i class="fa fa-book"></i> <span>Booking</span></a></li>
        <li class="{{ Request::segment(1) === 'project_member' ? 'active' : '' }} {{ $isSuperAdmin }}" ><a href="{{ url('/project_member') }}"><i class="fa fa-bolt"></i> <span>Inject Event</span></a></li>
        <li class="{{ Request::segment(1) === 'task' ? 'active' : '' }} {{ $isSuperAdmin }}" ><a href="{{ url('/admin/crewSalary') }}"><i class="fa fa-money"></i> <span>Crew Salary</span></a></li>
        <li class="{{ Request::segment(1) === 'All User' ? 'active' : '' }}" ><a href="{{ url('/admin/allUser') }}"><i class="fa fa-users"></i> <span>All User</span></a></li>
        <li class="{{ Request::segment(1) === 'All Admin' ? 'active' : '' }} {{ $isSuperAdmin }}" ><a href="{{ url('/admin/allAdmin') }}"><i class="fa fa-users"></i> <span>All Admin</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>