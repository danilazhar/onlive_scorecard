<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <span class="brand-text font-weight-light"><b>Online Scorecard</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            @if(request()->session()->get('is_verified'))
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p >Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('user*')) ? 'menu-is-opening menu-open' : '' }}">
                <a href="{{ route('user') }}" class="nav-link {{ (request()->is('user*')) ? 'menu-is-opening menu-open active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('role*')) ? 'menu-is-opening menu-open' : '' }}">
                <a href="{{ route('role') }}" class="nav-link {{ (request()->is('role*')) ? 'menu-is-opening menu-open active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                    <p>Roles</p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('department*')) ? 'menu-is-opening menu-open' : '' }}">
                <a href="{{ route('department') }}" class="nav-link {{ (request()->is('department*')) ? 'menu-is-opening menu-open active' : '' }}">
                <i class="nav-icon fas fa-user-check"></i>
                    <p>Departments</p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('scorecard/passrate*', 'scorecard/category*', 'scorecard/sub_category*', 'scorecard/criteria*')) ? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('scorecard/passrate*', 'scorecard/category*', 'scorecard/sub_category*', 'scorecard/criteria*')) ? 'menu-is-opening menu-open active' : '' }}">
                <i class="nav-icon fas fa-plus-square"></i>
                    <p>Scorecard Setup</p>
                    <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('passrate') }}" class="nav-link {{ (request()->is('scorecard/passrate*')) ? 'active' : '' }}">
                        <span style="margin-left: 10px;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Passing Score</p>
                        </span>
                    </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('category') }}" class="nav-link {{ (request()->is('scorecard/category*')) ? 'active' : '' }}">
                        <span style="margin-left: 10px;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Category</p>
                        </span>
                    </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('sub_category') }}" class="nav-link {{ (request()->is('scorecard/sub_category*')) ? 'active' : '' }}">
                        <span style="margin-left: 10px;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sub Category</p>
                        </span>
                    </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('criteria') }}" class="nav-link {{ (request()->is('scorecard/criteria*')) ? 'active' : '' }}">
                        <span style="margin-left: 10px;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Evaluation Criteria</p>
                        </span>
                    </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ (request()->is('scorecard/department/category*', 'scorecard/department/sub_category*', 'scorecard/department/criteria*')) ? 'menu-is-opening menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('scorecard/department/category*', 'scorecard/department/sub_category*', 'scorecard/department/criteria*')) ? 'menu-is-opening menu-open active' : '' }}">
                <i class="nav-icon fas fa-building"></i>
                    <p>Department Setup</p>
                    <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('department_category') }}" class="nav-link {{ (request()->is('scorecard/department/category*')) ? 'active' : '' }}">
                        <span style="margin-left: 10px;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Category</p>
                        </span>
                    </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('department_subcategory') }}" class="nav-link {{ (request()->is('scorecard/department/sub_category*')) ? 'active' : '' }}">
                        <span style="margin-left: 10px;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sub Category</p>
                        </span>
                    </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ route('department_criteria') }}" class="nav-link {{ (request()->is('scorecard/department/criteria*')) ? 'active' : '' }}">
                        <span style="margin-left: 10px;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Evaluation Criteria</p>
                        </span>
                    </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ (request()->is('scorecard/evaluation*')) ? 'menu-is-opening menu-open' : '' }}">
                <a href="{{ route('evaluation') }}" class="nav-link {{ (request()->is('scorecard/evaluation*')) ? 'menu-is-opening menu-open active' : '' }}">
                <i class="nav-icon fas fa-user-tie"></i>
                    <p>Employee Evaluation</p>
                </a>
            </li>
            @else
            <li class="nav-item">
                <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-check-square"></i>
                    <p >Verify User</p>
                </a>
            </li>
            @endif
        </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>