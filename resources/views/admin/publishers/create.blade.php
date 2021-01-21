@extends('admin.layouts.default')
@section('content')
<div class="breadcrumbs-area">
    <h3>Events</h3>
    <ul>
        <li>
            <a href="{{ url('/admin/home')}}">Home</a>
        </li>
        <li>Add New Publisher</li>
    </ul>
</div>
<!-- Breadcubs Area End Here -->
<!-- Add New Publisher Area Start Here -->
<div class="card ui-tab-card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <div class="basic-tab">
            <form class="new-added-form" id="publisherForm" method="POST" enctype="multipart/form-data" action="{{ route('addPublisher') }}">
                @csrf
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>PUBLISHER DETAILS</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>Name *</label>
                        <input type="text" name="name" placeholder="" class="form-control" value="{{$publisher->name ?? ''}}">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <input type="hidden" name="id" value="{{$publisher->id ?? 0}}">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>Logo (optional)</label>
                        <input type="file" name="logo" id="logo" accept="image/*" class="form-control-file">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <div class="item-img-custom">
                            <img src="{{isset($publisher->logo) ? asset('logos/publishers/'.$publisher->logo) : '/admin/img/figure/parents.jpg'}}" alt="student" id="logoPreview">
                        </div>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="button" class="btn-fill-md text-light bg-dark-pastel-green radius-4" id="btnSave">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{ asset('js/publisher.js') }}"></script>
@stop