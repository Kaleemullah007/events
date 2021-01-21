@extends('admin.layouts.default')
@section('content')
<div class="breadcrumbs-area">
    <h3>Users</h3>
    <ul>
        <li>
            <a href="{{ url('/admin/home')}}">Home</a>
        </li>
        <li>All Users</li>
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
                <h3>All Users Data</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table display data-table text-nowrap" id="usersDatatable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>User Name</th>
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
        
        var userTable = $('#usersDatatable').DataTable({
            language: {
                searchPlaceholder: "Search by name"
            },
            searching: true,
            info: false,
            lengthChange: false,
            //processing: true,
            serverSide: true,
            ajax: "{{ url('admin/users/fetchList') }}",
            "columnDefs": [{
                "targets": 7,
                "orderable": false,
                "className": 'text-center'
            }],
            columns: 
            [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email'},
                { data: 'user_name', name: 'user_name'},
                { data: 'created_at', name: 'created_at'},
                { data: 'action', name: 'action'}
            ]
        });

        $('#usersDatatable').on('click', '.btnStatus', function(){
            if (confirm('Are you sure you want to change status?')) {
                $.ajax({
                    type: "POST",
                    url: "/admin/users/changeStatus",
                    data: {id: $(this).data('id'), status: $(this).data('status')},
                    cache: false,
                    success: function(data){
                        if(data.status == 200){
                            alert('Status updated successfully.');
                            userTable.ajax.reload();
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