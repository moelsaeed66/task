<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create()
    {
        $post_id=$_GET['post'];
        return view('comments.create',compact('post_id'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'content'=>['required','string'],
        ]);
        $user_id=Auth::id();
        $request->merge([
            'user_id'=>$user_id,
        ]);
        $comment=Comment::create($request->all());
        event(new CommentAdded($comment));
        return redirect()->route('posts.index')->with('success','Comments Add Success');
    }

    public function delete($id)
    {
        $comment=Comment::find($id);
        $user_id=Auth::id();
        if($user_id == $comment->user_id)
        {
            $comment->delete();
        }
        return redirect()->route('posts.index')->with('success','Comments Deleted Success');
    }
}
