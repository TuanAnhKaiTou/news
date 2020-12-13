<div class="topbar-menu">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="{{ route('news.list') }}">News</a>
                </li>

                <li class="has-submenu">
                    <a href="{{ route('category.list') }}">Category</a>
                </li>

                <li class="has-submenu">
                    <a href="{{ route('source.list') }}">Source</a>
                </li>

                <li class="has-submenu">
                    <a href="{{ route('user.list') }}">User</a>
                </li>

                @if (Auth::user()->role_id == 1)
                    <li class="has-submenu">
                        <a href="{{ route('admin.list') }}">Admin</a>
                    </li>
                @endif

                {{-- <li class="has-submenu">
                    <a href="#"> <i class="la la-clone"></i>Layouts</a>
                    <ul class="submenu">
                        <li>
                            <a href="layouts-topbar-dark.html">Topbar Dark</a>
                        </li>
                        <li>
                            <a href="layouts-menubar-light.html">Menubar Light</a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
