@extends('layouts.my_app')

@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">{{$post->title}}</h1>
                <p>{{$post->text}}</p>
                <img style="width: 300px; height: 300px;" src="{{asset($post->photo)}}"/>

                <br></br>

                <a style="margin-right: 50px;" href="https://getbootstrap.com/docs/5.0/examples/album/#"
                   class="btn btn-primary my-2">
                    {{__('message.Like')}}}({{$post->likes()->count()}})</a>

            </div>
        </div>
    </section>

    @foreach($post->comments as $comment)
        <div style="margin-left: 500px;">
            <h3>{{$comment->user->name}}</h3>
            <p>{{$comment->text}}</p>
            @if($comment->photo)
                <img style="width: 90px; height: 90px;" src="{{asset($comment->photo)}}"/>
            @endif

            <h5>{{$comment->created_at}}</h5>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                @can('update',$comment)
                    <a href="{{route('comments.edit',$comment->id)}}" class="btn btn-success">
                        {{__('message.Edit')}}</a>
                @endcan

                @can('delete', $comment)
                    <form method="post" action="{{route('comments.destroy',$comment->id)}}">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger">
                            {{__('message.Delete')}}
                        </button>
                    </form>
                @endcan
            </div>
        </div>
        <br/>
        <br/>
        <br/>
    @endforeach

    @can('create',\App\Models\Comment::class)
        <form method="POST" action="{{route('comments.store')}}" style="margin-left: 500px;">
            @csrf

            <input name="post_id" type="hidden" value="{{$post->id}}">
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('message.Enter The Comment Text')}}</label>
                <input type="text" class="form-control" name="text">
                @error('text')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">{{__('message.Enter The Comment photo')}}</label>
                <input type="file" for="formFileLg" class="form-label" name="photo">
                @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button style="margin-left: 150px;" type="submit" class="btn btn-primary">{{__('message.Create')}}}</button>
        </form>
    @endcan

@endsection
