<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="{{ asset('backend/assets/img/logo.png') }}"
                    class="header-logo" /> <span class="logo-name">Rajmohol</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
                <a href="index.html" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Bookings</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="widget-chart.html">Add Booking</a></li>
                    <li><a class="nav-link" href="{{ route('booking.index') }}">All Bookings</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="mail"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="email-inbox.html">Customers</a></li>
                    <li><a class="nav-link" href="email-compose.html">User</a></li>
                </ul>
            </li>
            <li class="menu-header">Settings</li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="flag"></i><span>Web</span></a>
                <ul class="dropdown-menu">
                    <li><a href="carousel.html">All Sliders</a></li>
                    <li><a class="nav-link" href="owl-carousel.html">Add Sliders</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li><a href="carousel.html">All Blogs</a></li>
                    <li><a class="nav-link" href="owl-carousel.html">Add Blog</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li><a href="carousel.html">Contacts</a></li>
                    <li><a href="carousel.html">Reviews</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="flag"></i><span>Rooms</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('room.index') }}">All Rooms</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('room.class.index') }}">All Room Classes</a></li>
                </ul>

            </li>
        </ul>
    </aside>
</div>
