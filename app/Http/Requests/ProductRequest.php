<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'subtitle' => 'required',
            'description' => 'required',
            'thumbnails' => 'nullable|image',
            'description' => 'required',
            'users_id' => 'required|exists:users,id',
            'categories_id' => 'required|exists:categories,id',
            'file' => 'nullable|string'
        ];
    }
}
