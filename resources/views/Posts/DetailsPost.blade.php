@extends('layouts.my_app')

@section('content')


    @if(!empty($post))
        <h3>{{$post->title}}</h3>
<h3>{{$post->text}}</h3>
<img  style="width: 90px; height: 90px;" src="{{asset($post->photo)}}">
    <ul>
        <li>
            <a >
                <span class="fa fa-thumbs-up">Like({{$likCtr}})</span>
            </a>
        </li>

       <li>
            <a >
                <span class="fa fa-thumbs-up">Edit</span>
            </a>
        </li>

        <li>
            <a >
                <span class="fa fa-thumbs-up">Delete</span>
            </a>
        </li>
    </ul>

    <ul>
        {{$post->comments()}}
    </ul>
@endif

@endsection
