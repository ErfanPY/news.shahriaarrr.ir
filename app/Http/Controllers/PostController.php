<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $comments = $post->comments;
        return view('post', compact(['post', 'comments']));
    }

    public function indexAuthor()
    {
        $user = auth()->user();

        $posts = $user->posts;

        return view('dashboard.post.posts', compact(['posts']));
    }

    public function create()
    {
        return view('dashboard.post.create-post', [
            "categories" => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            "name" => "required|max:255",
            "body" => "required",
            "category_id" => "nullable|exists:categories,id",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $post = $user->posts()->create($validated);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            
            $post->update(['image' => $imagePath]);
        }

        return redirect(route('dashboard.posts'))->with('success', 'با موفقیت ساخته شد!');
    }

    public function edit(Post $post)
    {               
        $categories = Category::all();
        return view('dashboard.post.edit-post', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => 'required|max:255', 
            'body' => 'required',
            "category_id" => "nullable|exists:categories,id",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath; 
        }

        $post->update($validated);

        return redirect(route('dashboard.posts'))->with('success', 'با موفقیت اپدیت شد!');
    }

    public function delete(Post $post)
    {
        $post->delete();

        return redirect(route('dashboard.posts'))->with('success', 'با موفقیت حذف شد!');
    }
}
