<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select all Posts for show them
       $posts = Post::all();
        return View('Posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('Posts.create');
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
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
           $file->move('Storage/Posts/',$new_file);

       }

     $id = Auth::id();
     Post::create([
         "user_id"=> $id,
         "text" =>$request->text,
         "photo" =>'/Storage/Posts/'.$new_file,
         // "user_id"=> Auth::id(),
        ]);

      //  return View('welcome')->with(['success' => 'تمت اضافة العنصر بنجاح']);
   return redirect()->back()->with(['success' => 'تمت اضافة العنصر بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {

       $post = Post::find($post_id);
       return view('Posts.edite',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id)
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
       $file->move('Storage/Posts/',$new_file);

   }

 //  $p = Post::all();
 $post = Post::find($post_id);
 $post->update([
     "text" =>$request->text,
     "photo" =>'/Storage/Posts/'.$new_file,
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
    public function delete($post_id)
    {
       $post = Post::find($post_id);
       $post ->comments() -> delete();
       $post->delete();
       return redirect()->back()->with(['success' => 'تمت حذف العنصر بنجاح']);
    }
}
