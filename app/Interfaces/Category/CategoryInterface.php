<?php

namespace App\Interfaces\Category;

interface CategoryInterface
{
    public function getAllCategory();
    public function getCategoryBySlug($slg);

    public function createCategory(array $data);
    public function updateCategoryBySlug($slug, array $data);
    public function destroyCategoryBySlug($id);

}
