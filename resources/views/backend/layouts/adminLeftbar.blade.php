<aside class="main-sidebar">
  <div class="sidebar">
    <div class="user-panel">
      <div class="image text-center">
        <img src="{{ url('') }}/dist/img/img1.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="info">
        <p>{{ auth('admin')->user()->name ?? 'Admin' }}</p>
        <a href="#"><i class="fa fa-envelope"></i></a>
        <a href="#"><i class="fa fa-gear"></i></a>

        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" style="background:none;border:none;cursor:pointer;color:#fff;">
            <i class="fa fa-power-off"></i>
          </button>
        </form>
      </div>
    </div>

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      
      <li>
        <a href="{{ route('admin.dashboard') }}">
          <i class="ti-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="ti-briefcase"></i> <span>Departments</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('admin.employees.index') }}">
              <i class="fa fa-angle-right"></i> All Employees
            </a>
          </li>
          <li>
            <a href="{{ route('admin.employees.create') }}">
              <i class="fa fa-angle-right"></i> Add Employee
            </a>
          </li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="ti-calendar"></i> <span>Leave Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-angle-right"></i> Leave Requests</a></li>
          <li><a href="#"><i class="fa fa-angle-right"></i> Leave Types</a></li>
        </ul>
      </li>

      <li>
        <a href="#"><i class="ti-time"></i> <span>Attendance</span></a>
      </li>

      <li>
        <a href="#"><i class="ti-money"></i> <span>Payroll</span></a>
      </li>

      <li>
        <a href="#"><i class="ti-bell"></i> <span>Notice Board</span></a>
      </li>

    </ul>
  </div>
</aside>