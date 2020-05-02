<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
        {{--  <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>  --}}
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="{{asset('images/user.png')}}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{Auth::user()->full_name}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{asset('images/user.png')}}" class="img-circle elevation-2" alt="User Image">

                    <p>
                        {{Auth::user()->full_name}} - {{Auth::user()->role->name}}
                        <small>{{Auth::user()->created_at->diffForHumans()}}</small>
                    </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                    @if(Auth::user()->role_id == 1)
                    <a href="{{route('superadmin.profile.details')}}" class="btn btn-default btn-flat">Profile</a>
                    @elseif(Auth::user()->role_id == 2)
                    <a href="{{route('admin.profile.details')}}" class="btn btn-default btn-flat">Profile</a>
                    @else
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                    @endif
                    <a class="btn btn-default btn-flat float-right" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Sign out
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
{{--  SignOut Form  --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
