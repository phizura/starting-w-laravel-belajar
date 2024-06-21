<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\Category\CategoryInterface;
use App\Interfaces\PostInterface;
use App\Models\Post;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{

    private $postinterface;
    private $categoryinterface;

    public function __construct(PostInterface $postinterface, CategoryInterface $categoryinterface)
    {
        $this->postinterface = $postinterface;
        $this->categoryinterface = $categoryinterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.post.index", [
            'posts' => $this->postinterface->getAllPostUser(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.post.create', [
            'categories' => $this->categoryinterface->getAllCategory(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response${title.value}
     */
    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 270);

        try {

            $this->postinterface->create($validatedData);

            return redirect('/dashboard/posts')->with('success', 'New post has been added!');
        } catch (\Throwable $err) {

            return redirect('/dashboard/posts')->with('error', 'Failed add post!' . $err);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = $this->postinterface->getOneByslug($slug);
        return view('dashboard.post.show', [
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = $this->postinterface->getOneByslug($slug);
        return view('dashboard.post.edit', [
            'post' => $post,
            'categories' => $this->categoryinterface->getAllCategory()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $slug)
    {

        $post = $this->postinterface->getOneByslug($slug);
        $validatedData = $request->validated();

        if ($request->file('image')) {
            if (request()->oldImg) {
                Storage::delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 270);

        try {

            $this->postinterface->update($slug, $validatedData);

            return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
        } catch (\Throwable $err) {

            return redirect('/dashboard/posts')->with('error', 'Failed update post!' . $err);
        }

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = $this->postinterface->getOneByslug($slug);
        if ($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);
        try {

            $this->postinterface->delete($slug);

            return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
        } catch (\Throwable $err) {

            return redirect('/dashboard/posts')->with('error', 'Failed delete post!' . $err);
        }
    }

    public function checkSlug(Request $request)
    {
        // return response()->json(['judul' => $request->title]);
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
