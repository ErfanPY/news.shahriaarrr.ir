<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $comments = $user->comments;

        return view('dashboard.comment.comments', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return view('dashboard.comment.edit-comment', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'content' => 'sometimes',
        ]);

        $comment->update($validated);

        return redirect(route('dashboard.comments'))->with('success', 'با موفقیت ویرایش شد!');
    }

    public function store(Request $request, Post $post)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'content' => 'required',
        ]);

        $validated['post_id'] = $post;

        $user->comments()->create($validated);

        return redirect(route('post.show', $post))->with('success', 'با موفقیت درج شد!');
    }

    public function delete(Comment $comment)
    {
        $comment->delete();

        return redirect(route('dashboard.comments'))->with('success', 'با موفقیت حذف شد!');
    }
}
