@extends('layouts.my_app')

@section('content')
    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
            @csrf


                <div class="form-group" >
                    <label for="formFileLg" class="form-label">Enter The Post Title</label>
                    <input type="text" class="form-control form-control-lg" name="title">
                <!-- @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                @enderror -->
                </div>

            <div class="form-group" >
                <label for="formFileLg" class="form-label">Enter The Post Text</label>
                <input type="text" class="form-control form-control-lg" name="text">
                <!-- @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror -->
            </div>

            <div class="form-group">
                <label for="formFileLg" class="form-label">Enter The Post photo</label>
                <input type="file" class="form-control form-control-lg" name="photo">
                <!-- @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror -->
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

    @endsection
