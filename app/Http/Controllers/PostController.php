<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::with('comments')->get();
//        dd($posts);
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $postRequest)
    {
        $user_id=Auth::id();
        $postRequest->merge([
            'user_id'=>$user_id,
        ]);
        Post::create($postRequest->all());
        return redirect()->route('posts.index')->with('success','Post Add Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $postRequest, Post $post)
    {
        $user_id=Auth::id();
        $postRequest->merge([
            'user_id'=>$user_id,
        ]);
        if($user_id == $post->user_id)
        {
            $post->update($postRequest->all());
        }

        return redirect()->route('posts.index')->with('success','Post Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $user_id=Auth::id();

        if($user_id == $post->user_id)
        {
            $post->delete();
        }
        return redirect()->route('posts.index')->with('success','Post Deleted Successfully');

    }
}
