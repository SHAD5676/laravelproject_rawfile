 <aside class="main-sidebar">
  <!-- sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="image text-center">
        <img src="{{ asset('dist/img/img1.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="info">
        <p>{{ auth('admin')->user()->name ?? 'Admin' }}</p>
        <a href="#"><i class="fa fa-envelope"></i></a>
        <a href="#"><i class="fa fa-gear"></i></a>

        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" style="background:none;border:none;">
            <i class="fa fa-power-off"></i>
          </button>
        </form>
      </div>
    </div>

    <!-- sidebar menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="treeview">
        <a href="#">
          <i class="ti-user"></i>
          <span>Employees</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          <li>
            <a href="{{ route('employees.index') }}">
              <i class="fa fa-angle-right"></i> All Employees
            </a>
          </li>

          <li>
            <a href="{{ route('employees.create') }}">
              <i class="fa fa-angle-right"></i> Add Employee
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
  <!-- /.sidebar -->
</aside>
