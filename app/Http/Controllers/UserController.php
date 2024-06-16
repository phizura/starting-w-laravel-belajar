<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show(User $author)
    {
        return view('posts', [
            'title' => "Post by Author: $author->name",
            'active' => "Post by Author",
            'posts' => $author->posts->load('category', 'author'),
        ]);
    }
}
