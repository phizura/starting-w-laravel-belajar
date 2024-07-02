<?php

namespace App\Http\Controllers;

use App\Interfaces\PostInterface;
use App\Services\CategoryService;
use App\Services\UserService;

class PostController extends Controller
{
    private $postinterface;
    private $categoryService;
    private $userService;

    public function __construct(PostInterface $postinterface, CategoryService $categoryService, UserService $userService)
    {
        $this->postinterface = $postinterface;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = $this->categoryService->getBySlug(request('category'));
            $title = ' in ' . $category->name;
        };
        if (request('author')) {
            $author = $this->userService->getUser(['key' => 'username', 'data' => request('author')]);
            $title = ' by ' . $author->name;
        };

        return view('posts', [
            'title' => 'All Post ' . $title,
            'active' => 'Blog',
            'posts' => $this->postinterface->getAll()
        ]);
    }

    public function show($slug)
    {
        $post = $this->postinterface->getOneByslug($slug);
        return view("post", [
            "title" => "Single Post",
            "active" => "Single Post",
            "post" => $post,
        ]);
    }
}
