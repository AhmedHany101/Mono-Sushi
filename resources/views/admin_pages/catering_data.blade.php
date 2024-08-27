@extends('layout.admin_layout')
@section('layout')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Catering Data</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{url('/admin/add/New/Catering')}}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Catering</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Video</th>
                            <th>Description</th>
                            <th>Edite</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Video</th>
                            <th>Description</th>
                            <th>Edite</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                        use Illuminate\Support\Str;
                        @endphp

                        @foreach($data as $item)
                        @php
                        $encrypted_id = Crypt::encryptString($item->id);
                        @endphp
                        <tr>
                            <td>
                                <video width="100" height="100" controls>
                                    <source src="{{ asset('/catering_videos/' . $item->video) }}" type="video/mp4">
                                </video>
                            </td>
                            <th>{{ Str::limit($item->description, 60) }}</th>
                            <th>
                                <a href="/admin/edite/catering/data/{{$encrypted_id}}" style="color: green;">
                                    Edit
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="green" viewBox="0 0 512 512">
                                        <!-- SVG path for edit icon -->
                                    </svg>
                                </a>
                            </th>
                            <th style="color: red;">
                                <a style="color: red;" href="#" class="delete-link" data-url="/admin/delete/catering/{{$encrypted_id}}">
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
                    var successMessage = $('<div>').addClass('alert').text('Catering Deleted successfully');
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