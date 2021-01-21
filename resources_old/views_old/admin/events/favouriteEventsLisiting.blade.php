@extends('admin.layouts.default')
@section('content')
<div class="breadcrumbs-area">
    <h3>Favourite Events</h3>
    <ul>
        <li>
            <a href="{{ url('/admin/home')}}">Home</a>
        </li>
        <li>All Favourite Events</li>
    </ul>
</div>
<!-- Breadcubs Area End Here -->
<!-- Student Table Area Start Here -->
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>All Favourite Events Data</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table display data-table text-nowrap" id="favouriteEventsDatatable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Organization Name</th>
                        <th>Title</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        
        var favouriteTable = $('#favouriteEventsDatatable').DataTable({
            language: {
                searchPlaceholder: "Search by title"
            },
            searching: true,
            info: false,
            lengthChange: false,
            //processing: true,
            serverSide: true,
            ajax: "{{ url('admin/events/fetchEventList') }}",
            "columnDefs": [{
                "targets": 4,
                "orderable": false,
                "className": 'text-center'
            }],
            columns: 
            [
                { data: 'id', name: 'id' },
                { data: 'organization_name', name: 'organization_name' },
                { data: 'title', name: 'title' },
                { data: 'created_at', name: 'created_at'},
                { data: 'action', name: 'action'}
            ]
        });

        $('#favouriteEventsDatatable').on('click', '.btnDelete', function(){
            if (confirm('Are you sure you want to delete this favourite event?')) {
                $.ajax({
                    type: "POST",
                    url: "/admin/events/deleteFavouriteEvent",
                    data: {id: $(this).data('id')},
                    cache: false,
                    success: function(data){
                        if(data.status == 200){
                            alert('Favourite event deleted successfully.');
                            favouriteTable.ajax.reload();
                        }else{
                            alert('Something went wrong. Please try again later.')   
                        }
                    }
                });
            }
        });
    });
</script>
@stop