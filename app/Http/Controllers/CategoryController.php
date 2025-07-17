<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show( $id){
        $category = Category::find($id);
        $posts = $category->posts()->where('status','don')->get();
        $name = $category->name;
        // dd($category);
        return view('cat.show',compact(['posts','name']));
    }
}
