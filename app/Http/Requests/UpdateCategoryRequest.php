<?php

namespace App\Http\Requests;

use App\Interfaces\Category\CategoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    private $categoryinterface;
    public function __construct(CategoryInterface $categoryinterface)
    {
        $this->categoryinterface = $categoryinterface;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:categories|max:255',
        ];
    }
}
