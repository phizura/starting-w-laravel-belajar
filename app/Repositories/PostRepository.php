<?php

namespace App\Repositories;

use App\Interfaces\PostInterface;
use App\Models\Post;

class PostRepository implements PostInterface
{
    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        return $this->post->latest()->filter(request(['search', 'category', 'author']))
            ->paginate(7)->withQueryString();
    }

    public function getAllPostUser()
    {
        return $this->post->where('user_id', auth()->user()->id)->get();
    }

    public function getOneByslug($slug)
    {
        return $this->post->firstWhere('slug', $slug);
    }

    public function create(array $data)
    {
        $this->post->create($data);
    }

    public function update($slug, array $data)
    {
        $post = $this->getOneByslug($slug);
        $post->update($data);
    }

    public function delete($slug)
    {
        $post = $this->post->getOneByslug($slug);
        $post->delete();
    }

}
