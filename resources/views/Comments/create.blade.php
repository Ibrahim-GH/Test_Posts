@extends('layouts.my_app')

@section('content')

    <form method="POST" action="{{route('comments.store')}}" enctype="multipart/form-data">
            @csrf


            <div class="form-group" >
                <label for="exampleInputEmail1">Enter The Comment Text</label>
                <input type="text" class="form-control" name="text">
                <!-- @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror -->
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Enter The Comment photo</label>
                <input type="file" for="formFileLg" class="form-label" name="photo">
                <!-- @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror -->
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>



@endsection
