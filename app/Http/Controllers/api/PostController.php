<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::with('comments')->get();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>['required','numeric','exists:users,id'],
            'title'=>['required','string'],
            'content'=>['required','string']
        ]);

        $post=Post::create($request->all());
        return response()->json($post,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'user_id'=>['required','numeric','exists:users,id'],
            'title'=>['required','string'],
            'content'=>['required','string']
        ]);
        $post=$post->update($request->all());
        return response()->json($post,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post=$post->delete();
        return response()->json($post,200);
    }
}
