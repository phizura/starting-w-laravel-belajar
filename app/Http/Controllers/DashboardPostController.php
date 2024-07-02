<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\CategoryService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{

    private $postService;
    private $categoryService;

    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view("dashboard.post.index", [
            'posts' => $this->postService->getAllPostUser(),
        ]);
    }

    public function create()
    {
        return view('dashboard.post.create', [
            'categories' => $this->categoryService->getAll(),
        ]);
    }


    public function store(StorePostRequest $request)
    {

        try {

            $this->postService->create($request);

            return redirect('/dashboard/posts')->with('success', 'New post has been added!');
        } catch (\Throwable $err) {

            return redirect('/dashboard/posts/create')->with('error', 'Failed add post!' . $err->getMessage());
        }
    }

    public function show($slug)
    {
        $post = $this->postService->getByslug($slug);
        return view('dashboard.post.show', [
            "post" => $post
        ]);
    }

    public function edit($slug)
    {
        return view('dashboard.post.edit', [
            'post' => $this->postService->getByslug($slug),
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function update(UpdatePostRequest $request, $slug)
    {

        try {

            $this->postService->update(['slug' => $slug, 'data' => $request]);


            return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
        } catch (\Exception $err) {

            return redirect('/dashboard/posts')->with('error', 'Failed update post!' . $err->getMessage());
        }

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    public function destroy($slug)
    {

        try {

            $this->postService->destroy($slug);
            return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
        } catch (\Throwable $err) {

            return redirect('/dashboard/posts')->with('error', 'Failed delete post!' . $err);
        }
    }

    public function checkSlug(Request $request)
    {

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
