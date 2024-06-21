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
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $category = $this->categoryinterface->getCategoryBySlug($this->route('category'));
        if (request()->name == $category->name) {
            // return redirect('/dashboard/categories')->with('warning', 'Canceled update data');
            return [];
        }
        return [
            'name' => 'required|unique:categories|max:255',
        ];
    }
}
