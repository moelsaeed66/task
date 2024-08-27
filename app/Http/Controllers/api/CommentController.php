<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments=Comment::with('post')->get();
//        dd($comments);
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>['required','numeric','exists:users,id'],
            'post_id'=>['required','numeric','exists:posts,id'],
            'content'=>['required','string']
        ]);

        $comment=Comment::create($request->all());
        return response()->json($comment,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content'=>['required','string']
        ]);
        $comment=$comment->update($request->all());
        return response()->json($comment,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment=$comment->delete();
        return response()->json($comment,200);
    }
}
