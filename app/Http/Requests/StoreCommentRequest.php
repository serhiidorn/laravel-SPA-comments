<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:comments,id'],
            'text' => ['required', 'string'],
            'username' => ['required', 'string', 'alpha_num', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'homepage' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'file', 'max:8192', 'mimes:jpg,jpeg,png,gif'],
            'file' => ['nullable', 'file', 'max:100', 'mimes:txt'],
        ];
    }
}
