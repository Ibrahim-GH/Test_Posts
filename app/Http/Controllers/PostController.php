<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Traits\MyTraits;
use Auth;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    use MyTraits;

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select pagination posts for show them
        $posts = Post::paginate(PAGINATION_COUNT);

        return View('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(PostRequest $request)
    {
        //make Validation from postRequest

        //save Photo with Trait MyTrait
        $file_name = $this->saveImage($request->photo, 'Storage/posts');

        $userId = Auth::id();
        Post::create([
            "user_id" => $userId,
            "title" => $request->title,
            "text" => $request->text,
            "photo" => isset($file_name) ? '/Storage/posts/' . $file_name : null,
        ]);

        return redirect()->route('posts.index')->with(['success' => __('Added successfully')]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return View('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequestRequest $request, Post $post)
    {
        //make Validation from postRequest

        //save Photo with Trait MyTrait
        $file_name = $this->saveImage($request->photo, 'Storage/posts');

        $post->update([
            "title" => $request->title,
            "text" => $request->text,
            "photo" => isset($file_name) ? '/Storage/posts/' . $file_name : $post->photo,
        ]);

        return redirect()->route('posts.index')->with(['success' => __('Updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //dd($post->id);
       $post->comments()->delete();
       $post->likes()->delete();
        $post->delete();
        return redirect()->back()->with(['success' => __('Deleted successfully')]);
    }

    public function like(Post $post)
    {
        $userId = Auth::id();
        if (!$post->likes()->where('user_id', $userId)->exists()) {
            $post->likes()->create([
                'user_id' => $userId,
            ]);
        } else {
            $post->likes()->where('user_id', $userId)->delete();
        }

        return redirect()->route('posts.index');
    }
}
