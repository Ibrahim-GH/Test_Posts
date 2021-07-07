@extends('layouts.my_app')

@section('content')


    <a class="btn btn-primary" type="submit" href="{{url('posts/create')}}" class="btn btn-primary"> Create</a>


    <!--
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Post Title</th>
            <th scope="col">Post Text</th>
            <th scope="col">Post Photo</th>
            <th scope="col">Operation</th>
            <th scope="col">Comments</th>
        </tr>
        </thead>

     <tbody>
    -->

    @foreach($posts as $post)
        <nav>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5>{{$post -> id}}</h5>
                            <h5 class="card-title">{{$post -> title}}</h5>
                            <p class="card-text">{{$post ->text}}</p>
                            <img style="width: 90px; height: 90px;" src="{{asset($post->photo)}}" class="card-img-top"
                                 alt="Card image cap">

                        </div>
                        <a href="{{route('posts.edit',['post'=> $post->id])}}" class="btn btn-primary">Edit</a>
                        <a href="{{route('posts.show', ['post' => $post->id])}}" class="btn btn-success">view details</a>
                        <a href="{{route('posts.like', ['post' => $post->id])}}" class="btn btn-block btn-primary">
                            <i class="fa fa-thumbs-up">Like ({{$post->likes()->count()}})</i></a>
                        <a href="{{route('posts.delete',['post' => $post->id])}}" class="btn btn-danger">Delete</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!--
    <tr>
        <th scope="row">{{$post -> id}}</th>
        <td>{{$post ->title}}</td>
        <td>{{$post ->text}}</td>
        <td><img  style="width: 90px; height: 90px;" src="{{asset($post->photo)}}"></td>
        <td><a href="{{url('posts/edit', ['post_id' => $post->id])}}" class="btn btn-primary">Edit</a></td>
        <td><a href="{{url('posts/delete', ['post_id' => $post->id])}}" class="btn btn-danger">Delete</a></td>
        <td><a href="{{url('comments/all', ['post_id' => $post->id])}}" class="btn btn-success">Comments</a></td>
        <td><a href="{{url('posts/like', ['post_id' => $post->id])}}" class="btn btn-success">
                <span class="fa fa-thumbs-up">Like</span></a></td>
    </tr>
-->

    @endforeach






@endsection
