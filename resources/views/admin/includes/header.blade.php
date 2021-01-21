<div class="nav-bar-header-one">
    <div class="header-logo">
        <a href="{{ url('/admin/home')}}">
            <img src="{{ url('/front/images/logo.png')}}" alt="logo">
        </a>
    </div>
     <div class="toggle-button sidebar-toggle">
        <button type="button" class="item-link">
            <span class="btn-icon-wrap">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
    </div>
</div>
<div class="d-md-none mobile-nav-bar">
    <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
        <i class="far fa-arrow-alt-circle-down"></i>
    </button>
    <button type="button" class="navbar-toggler sidebar-toggle-mobile">
        <i class="fas fa-bars"></i>
    </button>
</div>
<div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
    <ul class="navbar-nav">
        <li class="navbar-item header-search-bar">
            
        </li>
    </ul>
    <ul class="navbar-nav">
        <li class="navbar-item dropdown header-admin">
            <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-expanded="false">
                <div class="admin-title">
                    @php
                    $user = Auth::user();
                    @endphp
                    <h5 class="item-title">{{$user->first_name}}</h5>
                    <span>{{$user->role_id == 1 ? 'Admin' : 'User'}}</span>
                </div>
                <div class="admin-img">
                    <img src="{{isset($user->profile_image) ? asset('logos/profiles/'.$user->profile_image) : url('/admin/img/figure/parents.jpg')}}" style="max-height: 60px; max-width: 60px;" alt="Admin">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="item-header">
                    <h6 class="item-title">{{$user->first_name}}</h6>
                </div>
                <div class="item-content">
                    <ul class="settings-list">
                        <li><a href="{{ url('admin/profile') }}"><i class="flaticon-user"></i>My Profile</a></li>
                        <li><a href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="flaticon-turn-off"></i>Log Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>