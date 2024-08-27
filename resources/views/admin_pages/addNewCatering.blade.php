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
<form action="{{ url('/admin/add/catering') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="video">Video</label>
            <input type="file" class="form-control" id="video" name="video">
            @error('video')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" placeholder="Description"></textarea>
            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="images">Images</label>
            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
            @error('images')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Add Data</button>
</form>
</div>

@endsection