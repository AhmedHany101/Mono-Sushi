@extends('layout.admin_layout')
@section('layout')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dishes Data</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{url('/admin/add/new/item')}}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Dish</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Component</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Price Info</th>
                            <th>Edite</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Item Name</th>
                            <th>Component</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Price Info</th>
                            <th>Edite</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data as $item)
                        @php
                        $encrypted_id = Crypt::encryptString($item->id);
                        @endphp
                        <tr>
                            <th>{{$item->name}}</th>
                            <th>{{$item->component}}</th>
                            <td> <img src="{{asset('/dishes_images/'.$item->image)}}" style="height:80px;width:80px" class="me-4 border" alt="image" /></td>
                            <th>
                                @php
                                $category = $categories->where('id', $item->category_id)->first();
                                @endphp

                                @if($category)
                                {{$category->name}}
                                @endif
                            </th>
                            <th>
                                @foreach($pieces_data as $item2)
                                @if($item2->dish_id == $item->id)
                                <span style="color: green;">{{$item2->pieces_no}} Pices {{$item2->pieces_price}} LE</span><br>
                                @endif
                                @endforeach
                            </th>
                            <th><a href="/admin/edite/dish/data/{{$encrypted_id}}" style="color: green;">
                                 Etite 
                                 <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="green" viewBox="0 0 512 512">
                                    <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                </svg>
                                </a>
                            </th>
                            <th style="color: red;"><a style="color: red;" href="#" class="delete-link" data-url="/admin/delete/dish/{{$encrypted_id}}">Delete <i class="fas fa-trash"></i></a></th>

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