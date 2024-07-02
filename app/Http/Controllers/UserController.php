<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show($username)
    {
        $author = $this->userService->getUser([
            "key" => "username",
            "data" => $username
        ]);

        return view('posts', [
            'title' => "Post by Author: $author->name",
            'active' => "Post by Author",
            'posts' => $author->posts->load('category', 'author'),
        ]);
    }
}
