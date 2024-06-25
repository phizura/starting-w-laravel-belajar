<?php

namespace App\Http\Controllers;

use App\Interfaces\Category\CategoryInterface;
use App\Interfaces\PostInterface;
use App\Interfaces\User\UserInterface;

class PostController extends Controller
{
    private $postinterface;
    private $categoryinterface;
    private $userinterface;

    public function __construct(PostInterface $postinterface, CategoryInterface $categoryinterface, UserInterface $userinterface)
    {
        $this->postinterface = $postinterface;
        $this->categoryinterface = $categoryinterface;
        $this->userinterface = $userinterface;
    }
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = $this->categoryinterface->getCategoryBySlug(request('category'));
            $title = ' in ' . $category->name;
        };
        if (request('author')) {
            $author = $this->userinterface->getUserByUsername(request('author'));
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
