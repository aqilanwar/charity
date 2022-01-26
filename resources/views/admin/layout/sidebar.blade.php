
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('/')}}">
                <div class="sidebar-brand-text mx-3">STUDENT4CHARITY</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="{{ (request()->is('dashboard')) ? 'nav-item active' : 'nav-item' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

           
            @if (Auth::user()->role_id != '0')    
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    MANAGE 
                </div>
            @endif


            <!-- Nav Item - Pages Collapse Menu -->
            @if (Auth::user()->role_id == '2')    
                <li class="{{ (request()->is('manage/user')) ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="{{ route('all.user') }}">
                        <i class="fas fa-fw fa-user-alt"></i>
                        <span>Manage User</span></a>
                </li>
            @endif

            @if (Auth::user()->role_id != '0')    
                <li class="{{ (request()->is('manage/event')) ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="{{ route('all.event') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Manage Event</span></a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                PROFILE
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('profile.show')}}"  >
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Profile Setting</span>
                </a>
            </li>
            <hr class="sidebar-divider">

             <!-- Heading -->
             <div class="sidebar-heading">
                GO TO
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="{{ (request()->is('/')) ? 'nav-item active' : 'nav-item' }}">
                <a class="nav-link" href="{{ route('/') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home Page</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="{{ (request()->is('list.event')) ? 'nav-item active' : 'nav-item' }}">
                <a class="nav-link" href="{{ route('list.event') }}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>View Event</span></a>
            </li>



        </ul>
        <!-- End of Sidebar -->   
 