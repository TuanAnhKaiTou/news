<header id="topnav">

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/images/user.png') }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ml-1">
                            {{ Auth::user()->full_name }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown" style="width: 190px !important">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <span class="m-0 font-13">
                                Welcome <b>{{ Auth::user()->full_name }}</b>
                            </span>
                        </div>

                        <!-- item-->
                        <a href="{{ route('admin.show', ['id' => Auth::id()]) }}" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>
                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ route('news.list') }} " class="logo text-center">
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-dark.png') }}" alt="" height="26">
                        <!-- <span class="logo-lg-text-dark">Upvex</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">X</span> -->
                        <img src="{{asset('assets/images/logo-sm.png') }}" alt="" height="28">
                    </span>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end Topbar -->

    @include('partials.menu')
    <!-- end navbar-custom -->

</header>
