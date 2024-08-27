@extends('layout.admin_layout')
@section('layout')
<style>
    .form-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .form-group {
        margin-bottom: 4px;
    }

    .remove-input-btn {
        margin-top: 1.5rem;
    }
</style>
<div class="container-fluid">
    <form action="{{url('/admin/add/compo')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Compo Name</label>
                <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="Item Name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Price</label>
                <input type="number" class="form-control" name="cost" id="inputEmail4" placeholder="Compo Price">
                @error('cost')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="inputCity">Image</label>
                <input type="file" class="form-control" id="inputCity" name="image">
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- <div id="inputs-container">
            <div class="form-row">
       
                <div class="form-group col-md-4">
                    <label for="pieces-number-select-0">Set</label>
                 
                    <input type="text" name="pieces[0][compo_set]" id="pieces-set-0" class="form-control">
                    @error('pieces.0.compo_set')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="pieces-price-select">Image</label>
                    <input type="file" name="pieces[0][set_image]"  class="form-control">
                    @error('pieces.0.set_image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <button class="remove-input-btn btn btn-danger">Remove</button>
                </div>
            </div> -->
        <!-- </div> -->

        <!-- <button id="add-input-btn" type="button" class="btn btn-primary">Add Another Set</button> -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                function toggleRemoveButton() {
                    var removeButtons = $('.remove-input-btn');
                    removeButtons.toggle(removeButtons.length > 1);
                }

                // Check if the remove button should be initially visible
                toggleRemoveButton();
                $('#add-input-btn').click(function() {
                    var inputSets = $('.form-row');
                    var newIndex = inputSets.length;

                    var newInputs = `
            <div class="form-row">
               
                <div class="form-group col-md-4">
                    <label for="pieces-number-select-${newIndex}">Set </label>
                    <input type="text" name="pieces[${newIndex}][compo_set]" id="pieces-set-0" class="form-control">
                    @error('pieces.0.compo_set')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="pieces-price-select-${newIndex}">Image</label>
                    <input type="file" name="pieces[${newIndex}][set_image]"  class="form-control">
                    @error('pieces.0.set_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group col-md-2">
                    <button class="remove-input-btn btn btn-danger">Remove</button>
                </div>
            </div>`;

                    $('#inputs-container').append(newInputs);
                });

                // Event delegation to handle click events on dynamically added remove buttons
                $(document).on('click', '.remove-input-btn', function() {
                    $(this).closest('.form-row').remove();
                });

            });
        </script>

        <button type="submit" class="btn btn-primary">Add Data</button>
    </form>
</div>

@endsection