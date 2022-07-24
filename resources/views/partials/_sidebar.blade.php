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
                @if(auth()->user()->type == 'HR')
                <li class="menu-title">
                    <span>Employees</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'employees' ? 'active' : '' }}" href="{{ $dashboardLink . 'employees' }}">All Employees</a></li>
                        <li><a class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'rates' ? 'active' : '' }}" href="{{ $dashboardLink . 'rates' }}">Rates</a></li>
                        <li><a class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'sales-board' ? 'active' : '' }}" href="{{ $dashboardLink . 'sales-board' }}">Sales Board</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-scissors"></i> <span> Deductions</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'deduction-categories' ? 'active' : '' }}" href="{{ $dashboardLink . 'deduction-categories' }}">Categories</a></li>
                        <li><a class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'employee-deductions' ? 'active' : '' }}" href="{{ $dashboardLink . 'employee-deductions' }}">Set By Employee</a></li>
                    </ul>
                </li>
                @elseif(auth()->user()->type == 'Employee')
                <li class="{{ \Illuminate\Support\Facades\URL::current() == env('APP_URL') . $dashboardLink . 'payslips' ? 'active' : '' }}">
                    <a href="{{ $dashboardLink .'payslips' }}"><i class="la la-file-excel"></i> <span>Payslips</span></a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
