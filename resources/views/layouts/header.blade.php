<header class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a href="/" id="logo">Sample App</a>
            <nav>
                <ul class="nav pull-right">
                    <li><a href="/">Home</a></li>
                    <li><a href="/help">Help</a></li>
                    @if (Auth::check())
                        <li><a href="#">Users</a></li>
                        <li id="fat-menu" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Account <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('users/'.Auth::user()->id) }}">Profile</a></li>
                                <li><a href="{{ action('UsersController@edit', Auth::user()->id) }}">Settings</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('auth/logout') }}">Sign out</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ url('auth/login') }}">Sign in</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>
