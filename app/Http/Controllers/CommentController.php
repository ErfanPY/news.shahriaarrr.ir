<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }



    public function update(Comment $comment, Request $request) :RedirectResponse
    {
        $comment->approved = $request->approve;
        $comment->update();

        $message = "Comment has been " . ($request->approve ? "approved" : "unapproved");
        return back()->with('message', $message);
    }

    public function store($postID, Request $request) :RedirectResponse
    {
        $post = Post::find($postID);
        $post->comments()->create([
            'body' =>$request->body,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);

        return back();
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return back()->with('message', "Comment has been removed!");
    }
}
