<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('dashboard.category.index', [
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {

        try {
            $this->categoryService->create($request);

            return redirect()->back()->with('success', 'Category has been added!');
        } catch (\Throwable $err) {
            return redirect()->back()->with('error', 'Failed add category!' . $err);
        };
    }

    public function edit($slug)
    {
        $category = $this->categoryService->getBySlug($slug);
        return view('dashboard.category.edit', [
            'category' => $category
        ]);
    }

    public function update(UpdateCategoryRequest $request, $slug)
    {

        try {

            $this->categoryService->update($slug, $request);

            return redirect('/dashboard/categories')->with('success', 'Category has been updated!');
        } catch (\Throwable $err) {

            return redirect('/dashboard/categories')->with('error', 'Failed updat data!');
        }
    }

    public function destroy($slug)
    {
        try {

            $this->categoryService->destroy($slug);
            return redirect()->back()->with('success', 'Category has been deleted!');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Failed delete category!');
        };
    }
}
