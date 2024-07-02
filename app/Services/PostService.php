<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Interfaces\PostInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    private $postInterface;

    public function __construct(PostInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

    public function getAll()
    {
        return $this->postInterface->getAll();
    }

    public function getAllPostUser()
    {
        return $this->postInterface->getAllPostUser();
    }

    public function getBySlug($slug)
    {
        return $this->postInterface->getOneByslug($slug);
    }

    public function create($request)
    {
        $request->merge([
            "user_id" => auth()->user()->id,
            "excerpt" => Str::limit(strip_tags($request["body"]), 270)
        ]);

        $data = collect($request);

        if ($request->file('image')) {
            $data->put('image', $request->file('image')->store('post-images'));
        }

        $this->postInterface->create($data->all());
    }

    public function update($request)
    {

        $post = $this->postInterface->getOneByslug($request['slug']);

        $collec = collect($request['data'])->merge([
            'user_id' => auth()->user()->id,
            'excerpt' => Str::limit(strip_tags($request->body), 270)
        ]);

        if ($request->file('image')) {
            if (request()->oldImg) {
                Storage::delete($post->image);
            }
            $collec->merge(['image' => $request->file('image')->store('post-images')]);
        }

        $this->postInterface->update($request['slug'], $collec->all());
    }

    public function destroy($slug)
    {
        $post = $this->postInterface->getOneByslug($slug);

        if ($post->image) {
            Storage::delete($post->image);
        }

        $this->postInterface->delete($slug);
    }
}
