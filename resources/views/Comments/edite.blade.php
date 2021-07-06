@extends('layouts.my_app')

@section('content')

    <form method="POST" action="{{route('comments.update',['comment_id'=> $comment->id])}}" enctype="multipart/form-data">
            @csrf
            <!-- {{-- <input name="_token" value="{{csrf_token()}}"> --}} -->


            <div class="form-group" >
                <label for="formFileLg" class="form-label">Update The Comment Text</label>
                <input type="text" class="form-control" name="text" value="{{$comment->text}}">
                 <!-- @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror -->
            </div>

            <div class="form-group">
                <label for="formFileLg" class="form-label">Update The Comment photo</label>
                <input type="file" class="form-control form-control-lg" name="photo" value="{{$comment->photo}}">
                <img src="{{asset($comment->photo)}}" style="width: 90px; height: 90px;"/>
                <!-- @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror -->
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    @endsection
