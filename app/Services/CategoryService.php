<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Interfaces\Category\CategoryInterface;

class CategoryService
{
    private $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    public function getAll()
    {
        return $this->categoryInterface->getAll();
    }

    public function getByslug($slug)
    {
        return $this->categoryInterface->getByslug($slug);
    }

    public function create($data)
    {
        $data = collect($data)->merge([
            'slug' => Str::slug($data->name)
        ]);
        return $this->categoryInterface->create($data->all());
    }

    public function update($slug, $data)
    {
        $data = collect($data)->merge([
            'slug' => Str::slug($data->name)
        ]);

        return $this->categoryInterface->updateBySlug($slug, $data->all());
    }

    public function destroy($slug)
    {
        return $this->categoryInterface->destroyBySlug($slug);
    }
}
