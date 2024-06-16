<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories', [
            'title' => 'Post Categories',
            'active' => 'Categories',
            'categories' => Category::all(),
        ]);
    }

    public function show(Category $category)
    {
        return view('posts', [
            'title' => "Post by Category: $category->name",
            'active' => "Category",
            'posts' => $category->posts,
            'category' => $category->name
        ]);
    }
}
