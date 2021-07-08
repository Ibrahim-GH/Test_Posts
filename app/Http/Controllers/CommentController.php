<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //make Validation for posts
        $this->validate($request, [
            'post_id' => 'required|exists:posts,id',
            'text' => 'required|string',
            'photo' => 'file|nullable',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $new_file = time() . $file->getClientOriginalName();
            $file->move('Storage/comments/', $new_file);
        }

        $id = Auth::id();
        Comment::create([
            "user_id" => $id,
            "post_id" => $request->post_id,
            "text" => $request->text,
            "photo" => isset($new_file) ? '/Storage/posts/' . $new_file : null,
        ]);

        return redirect()->back()->with(['success' => 'تمت اضافة العنصر بنجاح']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\comment $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('Comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
       //   dd($request->all());
        //make Validation for posts
        $this->validate($request, [
            'text' => 'required|string',
            'photo' => 'file|nullable',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $new_file = time() . $file->getClientOriginalName();
            $file->move('Storage/Comments/', $new_file);
        }

        $comment->update([
            "text" => $request->text,
            "photo" => isset($new_file) ? '/Storage/posts/' . $new_file : $comment->photo,
        ]);

        return redirect()->route('posts.show',$comment->post_id)->with(['success' => 'تمت اضافة العنصر بنجاح']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        // dd($comment_id);
        $comment->delete();
        return redirect()->back()->with(['success' => 'تمت حذف العنصر بنجاح']);
    }
}
