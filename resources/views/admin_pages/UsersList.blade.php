@extends('layout.admin_layout')
@section('layout')
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="{{asset('admin_front/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User List</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive tab_data">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number Of Orders</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number Of Orders</th>
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
                            <td>{{$item->email}}</td>
                            @php
                            $orderCount = App\Models\orders::where('user_id', $item->id)->count();
                            @endphp
                            <td style="color: green;">{{$orderCount}} order(s)</td>
                            <th style="color: red;"><a style="color: red;" href="#" class="delete-link" data-url="/admin/delete/user/{{$encrypted_id}}">Delete <i class="fas fa-trash"></i></a></th>
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
            row.remove();
                    var successMessage = $('<div>').addClass('alert').text('User Deleted successfully');
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