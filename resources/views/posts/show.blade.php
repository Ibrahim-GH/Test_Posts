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

    @foreach($post->comments as $comment)
        <div>
            <h3>{{$comment->user->name}}</h3>
            <p>{{$comment->text}}</p>
            @if($comment->photo)
                <img style="width: 90px; height: 90px;" src="{{asset($comment->photo)}}"/>
            @endif
        </div>
        <br/>
        <br/>
        <br/>
    @endforeach
@endsection
