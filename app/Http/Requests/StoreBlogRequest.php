<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::authorize('Create blog', Blog::class);
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'image' => 'required|image',
            'body' => 'required|string|max:1000'
        ];
    }

    protected function prepareForValidation()
    {
        // user can't have more than 5 blogs
        if (auth()->user()->blogs()->count() > 5) {
            $this->getValidatorInstance()
                ->errors()
                ->add('blogs_count', 'You\'ve reached max blogs number');
        }

        throw_if($this->validator, ValidationException::class, $this->validator);
    }
}
