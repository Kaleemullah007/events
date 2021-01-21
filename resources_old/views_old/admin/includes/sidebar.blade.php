<div class="mobile-sidebar-header d-md-none">
    <div class="header-logo">
        <a href="{{ url('/admin/home')}}"><img src="{{ url('/admin/img/logo1.png')}}" alt="logo"></a>
    </div>
</div>
<div class="sidebar-menu-content">
    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
        <li class="nav-item sidebar-nav-item">
            <a href="#" class="nav-link"><i class="flaticon-dashboard"></i><span>Events</span></a>
            <ul class="nav sub-group-menu">
                <li class="nav-item">
                    <a href="{{ url('/admin/events/listing')}}" class="nav-link"><i class="fas fa-angle-right"></i>Events</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/events/add')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add Event</a>
                </li>
                @cannot('isAdmin')
                <li class="nav-item">
                    <a href="{{ url('/admin/events/favouriteEventsListing')}}" class="nav-link"><i class="fas fa-angle-right"></i>Favourite Event</a>
                </li>
                @endcannot
            </ul>
        </li>
        @can('isAdmin')  
        <li class="nav-item sidebar-nav-item">
            <a href="#" class="nav-link"><i class="flaticon-calendar"></i><span>Publishers</span></a>
            <ul class="nav sub-group-menu">
                <li class="nav-item">
                    <a href="{{ url('/admin/publishers/listing')}}" class="nav-link"><i class="fas fa-angle-right"></i>Publishers</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/publishers/add')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add Publisher</a>
                </li>
            </ul>
        </li>
        @endcan
        @can('isAdmin')  
        <li class="nav-item sidebar-nav-item">
            <a href="#" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>Users</span></a>
            <ul class="nav sub-group-menu">
                <li class="nav-item">
                    <a href="{{ url('/admin/users/listing')}}" class="nav-link"><i class="fas fa-angle-right"></i>Users</a>
                </li>
            </ul>
        </li>
        @endcan
       
    </ul>
</div>