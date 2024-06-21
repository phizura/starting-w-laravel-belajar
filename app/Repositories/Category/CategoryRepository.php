<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Interfaces\Category\CategoryInterface;

class CategoryRepository implements CategoryInterface
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllCategory()
    {
        return $this->category->all();
    }

    public function getCategoryBySlug($slug)
    {
        return $this->category->where("slug", $slug)->firstOrFail();
    }

    public function createCategory(array $data)
    {
        $this->category->create($data);
    }

    public function updateCategoryBySlug($slug, array $data)
    {
        $category = $this->getCategoryBySlug($slug);
        $category->update($data);
    }

    public function destroyCategoryBySlug($slug)
    {
        $category = $this->getCategoryBySlug($slug);
        $category->delete();
    }
}
