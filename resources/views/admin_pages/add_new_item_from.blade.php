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
    <form action="{{url('/admin/add/new/dish')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Item Name</label>
                <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="Item Name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Component</label>
                <textarea type="text" name="component" class="form-control" id="inputPassword4" placeholder="Component"></textarea>
                @error('component')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Image</label>
                <input type="file" class="form-control" id="inputCity" name="image">
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="inputState">Category</label>
                <select id="inputState" name="category" class="form-control">
                    
                    @foreach($category as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('category')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div id="inputs-container">
            <!-- Existing set of inputs -->
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="inputCity">Pieces Number</label>
                    <input type="number" class="form-control" name="pieces[0][pieces_no]">
                    @error('pieces.0.pieces_no')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-5">
                    <label for="inputCity">Pieces Price</label>
                    <input type="number" class="form-control" name="pieces[0][pieces_price]">
                    @error('pieces.0.pieces_price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <button class="remove-input-btn btn btn-danger">Remove</button>
                </div>
            </div>
        </div>
        <button id="add-input-btn" type="button" class="btn btn-primary">Add Another Set</button>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                // Function to toggle the visibility of the remove button
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
                <div class="form-group col-md-5">
                    <label for="inputCity">Pieces Number</label>
                    <input type="number" class="form-control" name="pieces[${newIndex}][pieces_no]" required>
                    @error('pieces.0.pieces_no')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group col-md-5">
                    <label for="inputCity">Pieces Price</label>
                    <input type="number" class="form-control" name="pieces[${newIndex}][pieces_price]" required>
                    @error('pieces.0.pieces_no')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group col-md-2">
                    <button class="remove-input-btn btn btn-danger">Remove</button>
                </div>
            </div>
            `;

                    $('#inputs-container').append(newInputs);
                    // Show the remove button after adding a new set of inputs
                    toggleRemoveButton();
                });

                // Event delegation to handle click events on dynamically added remove buttons
                $('#inputs-container').on('click', '.remove-input-btn', function() {
                    $(this).closest('.form-row').remove();
                    // Show/hide the remove button after removing a set of inputs
                    toggleRemoveButton();
                });
            });
        </script>
        <button type="submit" class="btn btn-primary">Add Data</button>
    </form>
</div>
</form>
@endsection