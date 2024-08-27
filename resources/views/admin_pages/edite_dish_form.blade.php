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
    <form action="{{url('/admin/edite/dish')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$dish->id}}">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Item Name</label>
                <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="Item Name" value="{{$dish->name}}">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Component</label>
                <textarea type="text" name="component" class="form-control" id="inputPassword4" placeholder="Component">
                {{$dish->component}}
                </textarea>
                @error('component')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCity">Current Image</label>
                <img src="{{ asset('/dishes_images/'.$dish->image) }}" style="height: 80px; width: 80px" class="me-4 border" alt="image">
            </div>
            <div class="form-group col-md-4">
                <label for="inputCity">Upload New Image</label>
                <input type="file" class="form-control" id="inputCity" name="image">
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Category</label>
                <select id="inputState" name="category" class="form-control">
                    <option value="{{ $dish->category_id }}">Current Category: {{ $dish->category->name }}</option>
                    @foreach($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('category')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @foreach($dish_picies as $item)
        @php
        $encrypted_id = Crypt::encryptString($item->id);
        @endphp
        <div id="inputs-container">
            <!-- Existing set of inputs -->
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="inputCity">Pieces Number</label>
                    <input type="number" class="form-control" name="pieces[0][pieces_no]" value="{{$item->pieces_no}}" readonly>
                    @error('pieces.0.pieces_no')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-5">
                    <label for="inputCity">Pieces Price</label>
                    <input type="number" class="form-control" name="pieces[0][pieces_price]" value="{{$item->pieces_price}}" readonly>
                    @error('pieces.0.pieces_price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <a href="/admin/delete/pices/info/{{$encrypted_id}}" class="remove-input-btn btn btn-danger">Remove</a>
                </div>
            </div>
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Save Data</button>
 

    </form>
</div>
@endsection