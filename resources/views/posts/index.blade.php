@extends('layouts.my_app')

@section('content')
    @can('create', \App\Models\Post::class)
        <a class="btn btn-primary" type="submit" href="{{url('posts/create')}}"
           class="btn btn-primary"> {{__('message.Create')}}
        </a>
    @endcan
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
                        @can('update', $post)
                            <a href="{{route('posts.edit',['post'=> $post->id])}}"
                               class="btn btn-primary">{{__('message.Edit')}}</a>
                        @endcan
                        <a href="{{route('posts.show', ['post' => $post->id])}}"
                           class="btn btn-success">{{__('message.view details')}}</a>

                        @auth()
                            <a href="{{route('posts.like', ['post' => $post->id])}}" class="btn btn-block btn-primary">
                                <i class="fa fa-thumbs-up">{{__('message.Like')}} ({{$post->likes()->count()}})</i></a>
                        @endauth
                        @can('delete', $post)
                            <form method="post" action="{{route('posts.destroy',['post' => $post->id])}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">{{__('message.Delete')}}</button>
                            </form>
                        @endcan
                    </div>
                </li>
            </ul>
        </nav>

    @endforeach

@endsection






