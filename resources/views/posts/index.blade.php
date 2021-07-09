@extends('layouts.my_app')

@section('content')

    @can('create', \App\Models\Post::class)
        <a class="btn btn-primary" type="submit" href="{{url('posts/create')}}"
           class="btn btn-primary"> {{__('message.Create')}}
        </a>
    @endcan

    <div class="album py-5 bg-light">
        <div class="container" >
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" >
                @foreach($posts as $post)
                    <div class="col-xxl-3">
                        <div class="card shadow-sm">
                            <img style="width: 350px; height: 250px;" x="100%" y="100%" dy=".3em"
                                 src="{{asset($post->photo)}}" class="card-img-top">

                            <div class="card-body">
                                <h5 class="card-title">{{$post -> title}}</h5>
                                <p class="card-text">{{$post ->text}}</p>
                                <small>{{$post->created_at}}</small>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">

                                        @can('update', $post)
                                            <a href="{{route('posts.edit',['post'=> $post->id])}}"
                                               class="btn btn-primary">{{__('message.Edit')}}</a>
                                        @endcan

                                        <a href="{{route('posts.show', ['post' => $post->id])}}"
                                           class="btn btn-success">{{__('message.view details')}}</a>

                                        @auth()
                                            <a href="{{route('posts.like', ['post' => $post->id])}}"
                                            class="btn btn-block btn-primary">
                                            <i class="fa fa-thumbs-up">{{__('message.Like')}}
                                                ({{$post->likes()->count()}})</i></a>
                                        @endauth

                                        @can('delete', $post)
                                            <form method="post"
                                                  action="{{route('posts.destroy',['post' => $post->id])}}">
                                                @method('delete')
                                                @csrf
                                                <button style=" width: 50px; margin-right: 1px; padding-left: 4px;"
                                                        class="btn btn-danger">{{__('message.Delete')}}</button>
                                            </form>
                                        @endcan

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center " >
    {!!  $posts -> links() !!}
    </div>
@endsection
