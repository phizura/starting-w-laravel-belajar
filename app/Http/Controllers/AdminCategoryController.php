<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.category.index', [
            'categories' => Category::all()
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
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        $validatedData['slug'] = Str::slug($request->name);

        try {
            Category::create($validatedData);

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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
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
    public function update(Request $request, Category $category)
    {


        if ($request->name === $category->name) {
            return redirect('/dashboard/categories')->with('warning', 'Canceled update data');
        }

        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        try {


            Category::where('id', $category->id)
                ->update($validatedData);

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
    public function destroy(Category $category)
    {
        try {

            Category::destroy($category->id);
            return redirect()->back()->with('success', 'Category has been deleted!');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Failed delete category!');
        };
    }
}
