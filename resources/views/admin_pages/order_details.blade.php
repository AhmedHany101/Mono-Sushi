@extends('layout.admin_layout')
@section('layout')
<!-- Content Wrapper -->
<style>
  .small-image {
    width: 70px;
    height: 70px;
    border-radius: 50%;
  }

  .large-image {
    display: none;
    position: absolute;
    top: 60px;
    left: 50px;
    width: 300px;
    height: 300px;
  }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Order Details</h1>

    <!-- Content Row -->
    <div class="row">

        <!-- Grow In Utility -->
        <div class="col-lg-12">
            <div class="card position-relative">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order {{$order->id}}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col" style="padding-bottom: 10px;">
                                <h4 class="d-inline">Order Details</h4>
                                <button type="button" class="btn btn-primary d-inline" data-bs-toggle="modal" data-target="#exampleModal" data-id="{{ $order->id }}" id="btn-info">Add New Status</button>
                                <button type="button" class="btn btn-info d-inline">Current Status:
                                    <span style="text-decoration: underline;font-weight: bolder;"> @if($order->order_status == 0)
                                        Wating
                                        @elseif($order->order_status == 1)
                                        ON Way
                                        @else
                                        Done
                                        @endif
                                    </span>
                                </button>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Customer Phone</th>
                                    <th scope="col">Customer Address</th>
                                    <th scope="col">Customer City</th>
                                    <th scope="col">Shipping Cost</th>
                                    <th scope="col">Delivery Time</th>
                                    <th scope="col">Total price of item</th>
                                    <th scope="col">Coupon discount</th>
                                    <th scope="col" style="color: red;">Final Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{$order->name}}</th>
                                    <th scope="row">{{$order->phone}}</th>
                                    <th scope="row">{{$order->address}}</th>
                                    <th scope="row">{{$order->city}}</th>
                                    <th scope="row">{{$order->shipping_cost}}</th>
                                    <th scope="row">{{$order->arrivalTime}}</th>
                                    <th scope="row">{{$order->total}}</th>
                                    <th scope="row">{{$order->coupon_value}}</th>
                                    <th scope="row" style="color: red;">{{$order->grand_total}}</th>
                                </tr>
                            </tbody>
                        </table>
                        <h4>Order Item Details</h4>

                        @if($order_items->count() !=0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Itme Name</th>
                                    <th scope="col">Itme Component</th>
                                    <th scope="col">Product Details</th>
                                   
                                    <!-- <th scope="col">Total</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_items as $item)
                                <tr>
                                    <th scope="row">{{$item->product->name}}</th>
                                    <th scope="row">{{$item->product->component}}</th>
                                    <th scope="row">
                                        @foreach($order_item_pices as $order_item_pice)
                                        <span style="color: green;">{{$order_item_pice->qty}} * {{$order_item_pice->product_pieces}} Pices  of {{$order_item_pice->product->name}}</span><br> <span style="color:red;">{{$order_item_pice->qty}} X {{$order_item_pice->product_price}}={{$order_item_pice->qty * $order_item_pice->product_price}}LE</span><br>
                                       
                                        @endforeach
                                    </th>
                                    
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        @if($order_compo->count() != 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Compo Name</th>
                                    <th scope="col">Compo Cost</th>
                                    <th scope="col">Compo Set</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_compo as $compo)
                                <tr>
                                    <th scope="row">{{$compo->compo->name}}</th>
                                    <th scope="row">{{$compo->compo->total}}</th>
                                    <th>
                                        @foreach($comp_item as $compo_info)
                                        @if($compo_info->compo_id == $compo->compo->id)
                                        <img src="{{asset('/compo_image/'.$compo_info->set_image)}}" alt="" class="small-image"><br> <p style="color: black;">{{$compo_info->compo_set}}</p> <br><br>
                                        @endif
                                        @endforeach
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>



    </div>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Order Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Change Status Of Order Number : <span id="up_titel"></span></h4>
                <form action="{{url('/admin/change/status')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="up_id">
                    <select class="form-control" id="citySelect" name="status">
                        <option class="text-muted" value="0">Wating</option>
                        <option class="text-muted" value="1">ON Way</option>
                        <option class="text-muted" value="2">Done</option>
                    </select>

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

        // Set the values in the form fields
        $('#up_id').val(id);
        $('#up_titel').text(id);
        // Show the modal
        $('#exampleModal').modal('show');

    });
</script>
@endsection