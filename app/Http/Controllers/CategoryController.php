<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, Category $category)
    {
        $query = $category->posts()->where('status', 'accepted');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%");
        }

        $posts = $query->paginate(4)->withQueryString();
        $name = $category->name;
        
        return view('category', compact(['posts', 'name']));
    }

    public function showUncategorized(Request $request)
    {
        $query = Post::whereNull('category_id')->where('status', 'accepted');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%");
        }

        $posts = $query->paginate(4)->withQueryString();
        $name = "Uncategorized";

        return view('category', compact(['posts', 'name']));
    }
}
