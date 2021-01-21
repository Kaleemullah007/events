@extends('admin.layouts.default')
@section('content')
<div class="breadcrumbs-area">
    <h3>Events</h3>
    <ul>
        <li>
            <a href="{{ url('/admin/home')}}">Home</a>
        </li>
        <li>All Events</li>
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
                <h3>All Events Data</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table display data-table text-nowrap" id="eventsDatatable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Event Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Topics</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label">#0021</label>
                            </div>
                        </td>
                        <td class="text-center"><img src="img/figure/student2.png" alt="student"></td>
                        <td>2</td>
                        <td>Mark Willy</td>
                        <td>Male</td>
                        <td>A</td>
                        <td>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        
        var eventTable = $('#eventsDatatable').DataTable({
            language: {
                searchPlaceholder: "Search by name"
            },
            info: false,
            lengthChange: false,
            //processing: true,
            serverSide: true,
            ajax: "{{ url('admin/events/fetchList') }}",
            "columnDefs": [{
                "targets": 4,
                "orderable": false,
                "className": 'text-center'
            },
            {
                "targets": 5,
                "orderable": false,
                "className": 'text-center'
            }],
            columns: 
            [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'categories', name: 'categories'},
                { data: 'action', name: 'action'}
            ]
        });

        $('#eventsDatatable').on('click', '.btnDelete', function(){
            if (confirm('Are you sure you want to delete this event?')) {
                $.ajax({
                    type: "POST",
                    url: "/admin/events/delete",
                    data: {id: $(this).data('id')},
                    cache: false,
                    success: function(data){
                        if(data.status == 200){
                            alert('Event deleted successfully.');
                            eventTable.ajax.reload();
                        }else{
                            alert('Something went wrong. Please try again later.')   
                        }
                    }
                });
            }
        });

        $('#eventsDatatable').on('click', '.btnStatus', function(){
            if (confirm('Are you sure you want to change status?')) {
                $.ajax({
                    type: "POST",
                    url: "/admin/events/changeStatus",
                    data: {id: $(this).data('id'), status: $(this).data('status')},
                    cache: false,
                    success: function(data){
                        if(data.status == 200){
                            alert('Status updated successfully.');
                            eventTable.ajax.reload();
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