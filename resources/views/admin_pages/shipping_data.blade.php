@extends('layout.admin_layout')
@section('layout')
<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<link href="{{asset('admin_front/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Shipping Data</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#add_new_category">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Shipping Data</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive tab_data">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>Cost</th>
                            <th>Time to delivery</th>
                            <th>Edite</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>City</th>
                            <th>Cost</th>
                            <th>Time to delivery</th>
                            <th>Edite</th>
                            <th>delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data as $item)
                        @php
                        $encrypted_id = Crypt::encryptString($item->id);
                        @endphp
                        <tr>
                            <td>{{$item->city_name}}</td>
                            <td>{{$item->shipping_cost}}</td>
                            <td style="color: red;">{{$item->time_to_delivery}} hr</td>
                            <th>edite</th>
                            <th style="color: red;">
                                <a style="color: red;" href="#" class="delete-link" data-url="/admin/delete/city/{{$encrypted_id}}">
                                    Delete <i class="fas fa-trash"></i>
                                </a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="add_new_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Shipping Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form id="addnewshippingdata" method="POST" action="{{ url('admin/addnewshippingdata') }}" enctype="multipart/form-data">
                    <div id="err"></div>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">City Name</label>
                        <input type="text" name="city_name" class="form-control" id="city_name" aria-describedby="emailHelp" placeholder="Enter City Name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Shipping Cost</label>
                        <input type="number" class="form-control" id="shipping_cost" name="shipping_cost" aria-describedby="emailHelp" placeholder="Enter Shipping Cost" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Time To Delivery</label>
                        <input type="number" name="time_to_delivery" class="form-control" id="time_to_delivery" aria-describedby="emailHelp" placeholder="Enter City Name" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addnewshippingdata').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var successMessage = $('<div>').addClass('alert').text('Data Added successfully');
                    $('body').append(successMessage);
                    successMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
                        $(this).remove();
                    });
                    window.location.reload(true);
                },
                error: function(xhr, status, error) {
                    var successMessage = $('<div>').addClass('alert_danger').text(error);
                    $('body').append(successMessage);
                    successMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
                        $(this).remove();
                    });
                } 
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable(); // Initialize DataTables plugin

        // Event handler for delete link
        $('.delete-link').click(function(event) {
            event.preventDefault(); // Prevent the default link behavior

            var confirmation = confirm("Are you sure you want to delete?"); // Show a confirmation dialog

            if (confirmation) {
                var deleteUrl = $(this).data('url'); // Get the delete URL from the data attribute
                var row = $(this).closest('tr'); // Get the parent row of the clicked link

                $.ajax({
                    url: deleteUrl,
                    type: 'GET',
                    success: function(response) {
                    var successMessage = $('<div>').addClass('alert').text('Data Deleted successfully');
                    $('body').append(successMessage);
                    successMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
                        $(this).remove();
                    });
                    window.location.reload(true);
                },
                error: function(xhr, status, error) {
                    var successMessage = $('<div>').addClass('alert_danger').text(error);
                    $('body').append(successMessage);
                    successMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
                        $(this).remove();
                    });
                } 
                });
            }
        });
    });
</script>
@endsection