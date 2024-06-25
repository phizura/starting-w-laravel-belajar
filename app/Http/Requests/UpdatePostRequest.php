<?php

namespace App\Http\Requests;

use App\Interfaces\PostInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{

    private $postinterface;

    public function __construct(PostInterface $postinterface)
    {
        $this->postinterface = $postinterface;
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
        $post = $this->postinterface->getOneByslug($this->route('post'));

        $rules = [
            'title' => 'required|max:10',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|file|mimes:jpg,png|max:5024',
            'body' => 'required'
        ];

        if (request()->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.max' => 'To long',
            'category_id.required' => 'Kosong',
            'category_id.exists' => 'Tidak ada',
        ];
    }
}
