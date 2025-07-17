<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id){
        $category = Category::findOrFail($id);
        $posts = $category->posts()->where('status', 'done')->get();
        $name = $category->name;
        return view('cat.show', compact(['posts', 'name']));
    }
}
