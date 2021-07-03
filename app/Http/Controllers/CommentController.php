<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $post = Post::find($post_id);

        $comments =$post->comments;

        return View('Comments.index',compact('post', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id)
    {
        $post = Post::find($post_id);
        return View('Comments.create' , compact('post'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request , $post_id)
    {

        //make Validation for Posts
      $this->validate($request,[
            'text'=>'required',
            'photo'=>'required',
        ]);


       if($request->hasFile('photo')){
           $file = $request->file('photo');
           $new_file = time().$file->getClientOriginalName();
           $file->move('Storage/Comments/',$new_file);
       }
       

      $id =  Auth::id();
    Comment::create([
        "user_id" => $id,
        "post_id" => $post_id,
         "text" =>$request->text,
         "photo" =>'/Storage/Comments/'.$new_file,
        ]);

   return redirect()->back()->with(['success' => 'تمت اضافة العنصر بنجاح']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\comment  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($comment_id)
    {

       $comment = Comment::find($comment_id);
       return view('Comments.edite',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $comment_id)
    {

       //make Validation for Posts
       $this->validate($request,[
        'text'=>'required',
        'photo'=>'required',
    ]);
//dd('test');

   if($request->hasFile('photo')){
       $file = $request->file('photo');
       $new_file = time().$file->getClientOriginalName();
       $file->move('Storage/Comments/',$new_file);

   }

 //  $p = Post::all();
 $coment = Comment::find($comment_id);
 $coment->update([
     "text" =>$request->text,
     "photo" =>'/Storage/Comments/'.$new_file,
     // "user_id"=> Auth::id(),
    ]);

  //  return View('welcome')->with(['success' => 'تمت اضافة العنصر بنجاح']);
return redirect()->back()->with(['success' => 'تمت اضافة العنصر بنجاح']);
 }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($comment_id)
    {
       $comment = Comment::find($comment_id);
       $comment->delete();
       return redirect()->back()->with(['success' => 'تمت حذف العنصر بنجاح']);
    }
}
