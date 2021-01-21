<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Jan 2020 15:11:03 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    @include('admin.includes.head')
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <div class="loading hide">
        <!-- <h1>Loading...</h1> -->
        <img src="{{ url('/admin/img/loader.gif')}}">
    </div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light">
            @include('admin.includes.header')
        </div>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
                @include('admin.includes.sidebar')
            </div>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                @yield('content')
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="{{ asset('admin/js/jquery-3.3.1.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('admin/js/plugins.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <!-- Counterup Js -->
    <script src="{{ asset('admin/js/jquery.counterup.min.js') }}"></script>
    <!-- Moment Js -->
    <script src="{{ asset('admin/js/moment.min.js') }}"></script>
    <!-- Waypoints Js -->
    <script src="{{ asset('admin/js/jquery.waypoints.min.js') }}"></script>
    <!-- Scroll Up Js -->
    <script src="{{ asset('admin/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Full Calender Js -->
    <script src="{{ asset('admin/js/fullcalendar.min.js') }}"></script>
    <!-- Select 2 Js -->
    <script src="{{ asset('admin/js/select2.min.js') }}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('admin/js/datepicker.min.js') }}"></script>
    <!-- Chart Js -->
    <script src="{{ asset('admin/js/Chart.min.js') }}"></script>
    <!-- Jquery Validation Js -->
    <script src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
    <!-- Data Table Js -->
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('admin/js/main.js') }}"></script>
    @yield('js')
</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Jan 2020 15:11:36 GMT -->
</html>