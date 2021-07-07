@extends('layouts.my_app')

@section('content')

    <h3>{{$post->title}}</h3>
    <p>{{$post->text}}</p>
    <img style="width: 90px; height: 90px;" src="{{asset($post->photo)}}"/>

    <a>
        <span class="fa fa-thumbs-up">Like({{$post->likes()->count()}})</span>
    </a>

    <a>
        <span class="fa fa-thumbs-up">Edit</span>
    </a>

    <a>
        <span class="fa fa-thumbs-up">Delete</span>
    </a>
    <h3>This is Post</h3>
    </br>
    </br>

    @foreach($post->comments as $comment)
        <div>
            <h3>{{$comment->user->name}}</h3>
            <p>{{$comment->text}}</p>
            @if($comment->photo)
                <img style="width: 90px; height: 90px;" src="{{asset($comment->photo)}}"/>
            @endif
            <h5>{{$comment->created_at}}</h5>
            <a href="{{url('comments/{comment}/edit')}}" class="btn btn-success"> Edit</a>
            <a href="{{url('comments/{comment}',['$comment'=>$comment->id])}}" class="btn btn-danger"> Delete</a>
        </div>
        <br/>
        <br/>
        <br/>
    @endforeach

    <form method="POST" action="{{route('comments.store')}}" >
        @method('POST')
    @csrf

        <input name="post_id" type="hidden" value="{{$post->id}}" >
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
{{--         @error('photo')--}}
{{--            <small class="form-text text-danger">{{$message}}</small>--}}
{{--                @enderror--}}
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

@endsection
