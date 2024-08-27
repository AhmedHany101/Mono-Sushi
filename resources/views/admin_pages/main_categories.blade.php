@extends('layout.admin_layout')
@section('layout')
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="{{asset('admin_front/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Main Categories</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#add_new_category">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Category</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive tab_data">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Image</th>
                            <th>edite</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Category</th>
                            <th>Image</th>
                            <th>edite</th>
                            <th>delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data as $item)
                        @php
                        $encrypted_id = Crypt::encryptString($item->id);
                        @endphp
                        <tr>
                            <td>{{$item->name}}</td>
                            <td> <img src="{{asset('/category_images/'.$item->image)}}" style="height:80px;width:80px" class="me-4 border" alt="image" /></td>
                            <th>
                                <a href="#" data-bs-toggle="modal" data-target="#edite" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-image="{{ $item->image }}" id="btn-info">Edite</a>
                            </th>
                            <th style="color: red;"><a style="color: red;" href="#" class="delete-link" data-url="/admin/delete/category/{{$encrypted_id}}">Delete <i class="fas fa-trash"></i></a></th>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="addnewcataform" method="POST" action="{{ url('admin/addnewcategory') }}" enctype="multipart/form-data">
                    <div id="err"></div>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name <span style="color:red;">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload Image <span style="color:red;">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" aria-describedby="emailHelp" placeholder="Enter Image">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addnewcataform').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var successMessage = $('<div>').addClass('alert').text('Category Added successfully');
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
                        var successMessage = $('<div>').addClass('alert').text('Category Deleted successfully');
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


<div class="modal fade" id="edite" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edite Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editecataform" method="POST" action="{{ url('admin/edite/category') }}" enctype="multipart/form-data">
                    <div id="err"></div>
                    @csrf
                    <input type="hidden" name="id" id="up_id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="up_name" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <img id="current-image" src="" style="height:80px;width:80px" class="me-4 border" alt="image" />
                        <label for="exampleInputEmail1">Current Image</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).on('click', '#btn-info', function() {
            // Get the ID, title, description, and image values from the data attributes
            let id = $(this).data('id');
            let name = $(this).data('name');
            let image = $(this).data('image');

            // Set the values in the form fields
            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_image').val(image);

            // Display the current image
            $('#current-image').attr('src', "{{ asset('/category_images/') }}" + '/' + image);

            // Show the modal
            $('#edite').modal('show');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#editecataform').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                var formData = new FormData(this);
                var form = this; // Store the form reference

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        var successMessage = $('<div>').addClass('alert').text('Category Added successfully');
                        $('body').append(successMessage);
                        successMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#edite').modal('hide');
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
    @endsection