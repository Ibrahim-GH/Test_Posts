@extends('layouts.my_app')

@section('content')
    <form method="POST" action="{{route('posts.update',['post_id'=> $post->id])}}" enctype="multipart/form-data">
            @csrf
            <!-- {{-- <input name="_token" value="{{csrf_token()}}"> --}} -->

                <div class="form-group" >
                    <label for="exampleInputEmail1">Update The Post Title</label>
                    <input type="text" class="form-control" name="title" value="{{$post->title}}">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

            <div class="form-group" >
                <label for="exampleInputEmail1">Update The Post Text</label>
                <input type="text" class="form-control" name="text" value="{{$post->text}}">
                 @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Update The Post photo</label>
                <input type="file" for="formFileLg" class="form-label" name="photo" value="{{$post->photo}}">
                <img src="{{asset($post->photo)}}" style="width: 90px; height: 90px;"/>
                <!-- @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror -->
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    @endsection
