<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'index' ? 'active' : '' }}">
                    <a href="{{ $dashboardLink .'index' }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li clas
                <li class="menu-title">
                    <span>Employees</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'employees' ? 'active' : '' }}" href="{{ $dashboardLink . 'employees' }}">All Employees</a></li>
                        <li><a href="timesheet.html">Timesheet</a></li>
                        <li><a href="shift-scheduling.html">Shift & Schedule</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-scissors"></i> <span> Deductions</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'deduction-categories' ? 'active' : '' }}" href="{{ $dashboardLink . 'deduction-categories' }}">Categories</a></li>
                        <li><a class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'employee-deductions' ? 'active' : '' }}" href="{{ $dashboardLink . 'employee-deductions' }}">Set By Employee</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
