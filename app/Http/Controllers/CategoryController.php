<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Interfaces\Category\CategoryInterface;

class CategoryController extends Controller
{
    private $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    public function index()
    {
        return view('categories', [
            'title' => 'Post Categories',
            'active' => 'Categories',
            'categories' => $this->categoryInterface->getAllCategory(),
        ]);
    }

    public function show(categoryInterface $category)
    {
        return view('posts', [
            'title' => "Post by Category: $category->name",
            'active' => "Category",
            'posts' => $category->posts,
            'category' => $category->name
        ]);
    }
}
