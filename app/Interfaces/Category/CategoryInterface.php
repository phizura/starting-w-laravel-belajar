<?php

namespace App\Interfaces\Category;

interface CategoryInterface
{
    public function getAll();
    public function getBySlug($slg);

    public function create($data);
    public function updateBySlug($slug, $data);
    public function destroyBySlug($id);

}
