<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('categories', [
            'title' => 'Post Categories',
            'active' => 'Categories',
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function show($slug)
    {
        $category = $this->categoryService->getBySlug($slug);
        return view('posts', [
            'title' => "Post by Category: $category->name",
            'active' => "Category",
            'posts' => $category->posts,
            'category' => $category->name
        ]);
    }
}
