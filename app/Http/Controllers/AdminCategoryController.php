<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Interfaces\Category\CategoryInterface;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{

    private $categoryinterface;

    public function __construct(CategoryInterface $categoryinterface)
    {
        $this->categoryinterface = $categoryinterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.category.index', [
            'categories' => $this->categoryinterface->getAllCategory(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {

        $validatedData = $request->validated();

        $validatedData['slug'] = Str::slug($request->name);

        try {
            $this->categoryinterface->createCategory($validatedData);

            return redirect()->back()->with('success', 'Category has been added!');
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', 'Failed add category!' . $err);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryInterface $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = $this->categoryinterface->getCategoryBySlug($slug);
        return view('dashboard.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $slug)
    {


        $validatedData = $request->validated();
        if (!$validatedData) {
            return redirect('/dashboard/categories')->with('warning', 'Cannot input the same data ');
        }

        $validatedData['slug'] = Str::slug($request->name);


        try {

            $this->categoryinterface->updateCategoryBySlug($slug, $validatedData);

            return redirect('/dashboard/categories')->with('success', 'Category has been updated!');
        } catch (\Throwable $err) {

            return redirect('/dashboard/categories')->with('error', 'Failed updat data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $this->categoryinterface->destroyCategoryBySlug($id);
            // Category::destroy($category->id);
            return redirect()->back()->with('success', 'Category has been deleted!');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Failed delete category!');
        };
    }
}
