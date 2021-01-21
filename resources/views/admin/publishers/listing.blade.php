@extends('admin.layouts.default')
@section('content')
<div class="breadcrumbs-area">
    <h3>Publishers</h3>
    <ul>
        <li>
            <a href="{{ url('/admin/home')}}">Home</a>
        </li>
        <li>All Publishers</li>
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
                <h3>All Publishers Data</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table display data-table text-nowrap" id="publishersDatatable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Status</th>
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
        
        var publisherTable = $('#publishersDatatable').DataTable({
            language: {
                searchPlaceholder: "Search by name"
            },
            searching: true,
            info: false,
            lengthChange: false,
            //processing: true,
            serverSide: true,
            ajax: "{{ url('admin/publishers/fetchList') }}",
            "columnDefs": [{
                "targets": 4,
                "orderable": false,
                "className": 'text-center'
            }],
            columns: 
            [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'is_active', name: 'is_active' },
                { data: 'created_at', name: 'created_at'},
                { data: 'action', name: 'action'}
            ]
        });

        $('#publishersDatatable').on('click', '.btnDelete', function(){
            if (confirm('Are you sure you want to delete this publisher?')) {
                $.ajax({
                    type: "POST",
                    url: "/admin/publishers/delete",
                    data: {id: $(this).data('id')},
                    cache: false,
                    success: function(data){
                        if(data.status == 200){
                            alert('Publisher deleted successfully.');
                            publisherTable.ajax.reload();
                        }else{
                            alert('Something went wrong. Please try again later.')   
                        }
                    }
                });
            }
        });

        $('#publishersDatatable').on('click', '.btnStatus', function(){
            if (confirm('Are you sure you want to change status?')) {
                $.ajax({
                    type: "POST",
                    url: "/admin/publishers/changeStatus",
                    data: {id: $(this).data('id'), status: $(this).data('status')},
                    cache: false,
                    success: function(data){
                        if(data.status == 200){
                            alert('Status updated successfully.');
                            publisherTable.ajax.reload();
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