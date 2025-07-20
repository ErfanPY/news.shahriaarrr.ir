<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $comments = $user->comments_on_posts;

        return view('dashboard.post-comment.post-comments', compact(['comments']));
    }

    public function edit(Comment $comment)
    {
        return view('dashboard.post-comment.edit-comment', compact(['comment']));
    }

    public function update(Request $request, Comment $comment)
    {   
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,accepted,rejected',
        ]);

        $comment->update($validated);

        return redirect(route('dashboard.author.comments'))->with('success', '!با موفقیت ویرایش شد!');
    }
}
