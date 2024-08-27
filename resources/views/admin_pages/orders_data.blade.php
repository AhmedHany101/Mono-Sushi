@extends('layout.admin_layout')
@section('layout')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Orders Data</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Handle Orders Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive tab_data">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Total</th>
                            <th>Order Status</th>
                            <th style="color: red;">Delete <i class="fas fa-trash"></i></th>
                            <th style="color: green;">See Details</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>User Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Total</th>
                            <th>Order Status</th>
                            <th style="color: red;">Delete <i class="fas fa-trash"></i></th>
                            <th style="color: green;">See Details</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data as $item)
                        @php
                        $encrypted_id = Crypt::encryptString($item->id);
                        @endphp
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->city}}</td>
                            <td>{{$item->grand_total}}</td>
                            @if($item->order_status == 0)
                            <td>Wating</td>
                            @elseif($item->order_status == 1)
                            <td>OWay</td>
                            @else
                            <td>Done</td>
                            @endif
                            <th style="color: red;"><a href="#" class="delete-link" data-url="/admin/delete/order/{{$encrypted_id}}">Delete <i class="fas fa-trash"></i></a></th>                            <th style="color: green;"><a href="/admin/Order/Details/{{$encrypted_id}}"> <i class="fas fa-eye"></i></a></th>
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
        //   dataTable.ajax.reload(null, false); // Reload only the table data, keeping the current state
        },
       
      });
    }
  });
});
</script>

@endsection