@extends('admin.layouts.default')
@section('content')
<div class="breadcrumbs-area">
    <h3>{{$type}} Dashboard</h3>
    <ul>
        <li>
            <a href="{{ url('/admin/home')}}">Home</a>
        </li>
        <li>{{$type}}</li>
    </ul>
</div>
<!-- Breadcubs Area End Here -->
<!-- Dashboard summery Start Here -->
<div class="row gutters-20">
    @if($role ==1)
    <div class="col-xl-6 col-sm-6 col-12">
        <div class="dashboard-summery-one mg-b-20">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="item-icon bg-light-green ">
                        <i class="flaticon-classmates text-green"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="item-content">
                        <div class="item-title">Users</div>
                        <div class="item-number"><span class="counter" data-num="{{$users ?? 0}}">{{$users ?? 0}}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif;
    <div class="col-xl-6 col-sm-6 col-12">
        <div class="dashboard-summery-one mg-b-20">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="item-icon bg-light-blue">
                        <i class="flaticon-multiple-users-silhouette text-blue"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="item-content">
                        <div class="item-title">Events</div>
                        <div class="item-number"><span class="counter" data-num="{{$events ?? 0}}">{{$events ?? 0}}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard summery End Here -->
<!-- Dashboard Content Start Here -->
<!-- <div class="row gutters-20">
    <div class="col-12 col-xl-8 col-6-xxxl">
        <div class="card dashboard-card-one pd-b-20">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Earnings</h3>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-times text-orange-red"></i>Close</a>
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                    </div>
                </div>
                <div class="earning-report">
                    <div class="item-content">
                        <div class="single-item pseudo-bg-blue">
                            <h4>Total Collections</h4>
                            <span>75,000</span>
                        </div>
                        <div class="single-item pseudo-bg-red">
                            <h4>Fees Collection</h4>
                            <span>15,000</span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="date-dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">Jan 20, 2019</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Jan 20, 2019</a>
                            <a class="dropdown-item" href="#">Jan 20, 2021</a>
                            <a class="dropdown-item" href="#">Jan 20, 2020</a>
                        </div>
                    </div>
                </div>
                <div class="earning-chart-wrap">
                    <canvas id="earning-line-chart" width="660" height="320"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4 col-3-xxxl">
        <div class="card dashboard-card-two pd-b-20">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Expenses</h3>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-times text-orange-red"></i>Close</a>
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                    </div>
                </div>
                <div class="expense-report">
                    <div class="monthly-expense pseudo-bg-Aquamarine">
                        <div class="expense-date">Jan 2019</div>
                        <div class="expense-amount"><span>$</span> 15,000</div>
                    </div>
                    <div class="monthly-expense pseudo-bg-blue">
                        <div class="expense-date">Feb 2019</div>
                        <div class="expense-amount"><span>$</span> 10,000</div>
                    </div>
                    <div class="monthly-expense pseudo-bg-yellow">
                        <div class="expense-date">Mar 2019</div>
                        <div class="expense-amount"><span>$</span> 8,000</div>
                    </div>
                </div>
                <div class="expense-chart-wrap">
                    <canvas id="expense-bar-chart" width="100" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Dashboard Content End Here -->
@stop