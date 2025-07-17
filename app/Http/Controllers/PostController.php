<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('status','done')->paginate(10);
        // dd($posts);
        return view('post.index',compact('posts'));
    }


    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id',$id)->get();
        return view('post.show',compact(['post','comments']));
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->id())->get();
        return view('post.my-posts', compact('posts'));
    }

}
