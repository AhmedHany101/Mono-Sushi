@extends('layout.admin_layout')
@section('layout')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
        padding: 8px;
    }

    .expired-date {
        color: red;
    }
</style>
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="{{asset('admin_front/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Coupons Data</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#add_new_category">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Coupon</span>
            </a>
            <a href="{{ route('pdf.export') }}" class="btn btn-primary">Export to PDF</a>
        </div>

        <div class="card-body">
            <div class="table-responsive tab_data">
                <form action="{{ route('coupons.multiDelete') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="selectAllCheckbox">
                                </th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Discount Value</th>
                                <th>Expiration Date</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            @php
                            $currentDate = now();
                            $expirationDate = $item->expiration_date;
                            $isExpired = $expirationDate && $currentDate > $expirationDate;
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" name="selectedRows[]" value="{{ $item->id }}">
                                </td>
                                <td class="{{ $isExpired ? 'expired-date' : '' }}">{{$item->code}}</td>
                                <td class="{{ $isExpired ? 'expired-date' : '' }}">{{$item->description}}</td>
                                <td class="{{ $isExpired ? 'expired-date' : '' }}">{{$item->discount}}</td>
                                <td class="{{ $isExpired ? 'expired-date' : '' }}">
                                    @if($isExpired)
                                    Code Expired
                                    @else
                                    {{ $expirationDate }}
                                    @endif
                                </td>
                                <td>Delete</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                    <input type="checkbox" id="selectAllCheckbox">
                                </th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Discount Value</th>
                                <th>Expiration Date</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="m-2">
                        <button type="submit" class="btn btn-danger">Delete Selected</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="add_new_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('coupons.generate') }}" method="POST">
                    <div id="err"></div>
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount:</label>
                        <input type="number" name="discount" class="form-control" id="discount" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="expiration_date">Expiration Date:</label>
                        <input type="date" name="expiration_date" class="form-control" id="expiration_date" required>
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
    document.getElementById('selectAllCheckbox').addEventListener('change', function() {
        var checkboxes = document.getElementsByName('selectedRows[]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
</script>
@endsection