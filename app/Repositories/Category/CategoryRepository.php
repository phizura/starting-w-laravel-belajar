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

    public function getAll()
    {
        return $this->category->all();
    }

    public function getBySlug($slug)
    {
        return $this->category->where("slug", $slug)->firstOrFail();
    }

    public function create($data)
    {
        $this->category->create($data);
    }

    public function updateBySlug($slug, $data)
    {
        $category = $this->getBySlug($slug);
        $category->update($data);
    }

    public function destroyBySlug($slug)
    {
        $category = $this->getBySlug($slug);
        $category->delete();
    }
}
