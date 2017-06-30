<div class="over-nav">
    <div class="over-nav-inner-layer">
        <span class="m-title">Land Information Management System</span>
    </div>
</div>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="m-title m-title-brand">LIMS</span>
                {{--                {{ config('app.name', 'LIMS') }}--}}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                {{-- left side nav is empty! --}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right" style="margin-right: 18px;">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li><img src="{{ url('/images/pp.svg') }}" width="52px"></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <b>{{ Auth::user()->firstname.' '.Auth::user()->othernames }} </b> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu medium-menu" role="menu">
                            <li><a href="#">Profile <B>({{ \App\Role::find(Auth::user()->role_id)->role_name }})</B></a></li>
                            {{--<li><a href="#">Activity</a></li>--}}
                            {{--<li><a href="#">Help</a></li>--}}
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
