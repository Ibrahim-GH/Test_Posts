@extends('layouts.my_app')

@section('content')

    <a class="btn btn-primary" type="submit" href="{{url('comments/create',['$post_id' => $post->id])}}" class="btn btn-primary"> Create</a>

    <table class="table">

    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Comment Text</th>
        <th scope="col">Comment Photo</th>
        <th scope="col">Operation</th>
    </tr>
    </thead>

 <tbody>



@foreach($comments as $comment)
    <tr>
        <th scope="row">{{$comment -> id}}</th>
        <td>{{$comment ->text}}</td>
        <td><img  style="width: 90px; height: 90px;" src="{{asset($comment->photo)}}"></td>
        <td>
                <a href="{{url('comments/edit' , ['comment_id' =>$comment -> id])}}" class="btn btn-success"> Edit</a>
                <a href="{{route('comment.delete',['comment_id' =>$comment -> id])}}" class="btn btn-danger"> Delete</a>
             </td>

    </tr>
@endforeach

</tbody>
</table>

    @endsection
