@extends('layout.admin_layout')
@section('layout')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Compo Data</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{url('/admin/add/new/compo')}}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Compo</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Compo</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Set Number</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Compo</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Set Number</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($compo_data as $item)
                        @php
                        $encrypted_id = Crypt::encryptString($item->id);
                        @endphp
                        <tr>
                            <th><img src="{{asset('/compo_image/'.$item->image)}}" style="height:80px;width:80px" class="me-4 border" alt="image" /></th>
                            <th>{{$item->name}}</th>
                            <th>{{$item->total}}</th>
                            <th>{{ $item->compo_item->count() }}</th>
                            <th style="color: red;"><a style="color: red;" href="#" class="delete-link" data-url="/admin/delete/compo/{{$encrypted_id}}">Delete <i class="fas fa-trash"></i></a></th>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        // Handle the success response
                        row.remove(); // Remove the deleted row from the HTML table
                        var successMessage = $('<div>').addClass('alert').text('Item Deleted successfully');
                        $('body').append(successMessage);
                        successMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
                            $(this).remove();
                        });
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