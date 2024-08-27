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
    <form action="{{url('/admin/editCatering')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$catering->id}}" name="id">
        <div class="form-row">
            <div class="form-group col-md-6">
                <video width="100" height="100" controls>
                    <source src="{{ asset('/catering_videos/' . $catering->video) }}" type="video/mp4">
                </video>
            </div>
            <div class="form-group col-md-6">
                <label for="inputCity">Change Video</label>

                <input type="file" class="form-control" id="video" name="video">
                @error('video')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group col-md-8">
                <label for="inputPassword4">Description</label>
                <textarea type="text" name="description" class="form-control" id="description" placeholder="Description">{{$catering->description}}</textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Images</label>
                <div class="row mb-3">
                <div class="col">
                  <div class="row">
                    <label for="exampleFormControlFile1" class="mb-3" style="color:black;">Product Images</label>
                    @foreach($cateringImages as $item)
                <div class="col">
                    <img src="{{asset('/catering_images/'.$item->image)}}" style="height:80px;width:80px" class="me-4 border" alt="image" />
                    <a href="{{url('admin/delet_image/'.$item->id)}}" class="d-block" style="color:red"> Delete <i class="bi bi-trash3"></i></a>
                </div>
                @endforeach
                  </div>
                </div>
              </div>
              <div class="col">
                <input type="file" class="form-control" id="images" name="images[]" multiple>
                @error('images')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add Data</button>
    </form>
</div>
@endsection