<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class GetCommentsRequest extends FormRequest
{
    private array $allowedSortings = [
        'username' => ['username', 'asc'],
        'email' => ['email', 'asc'],
        'newest' => ['created_at', 'desc'],
        'oldest' => ['created_at', 'asc'],
    ];

    protected function prepareForValidation(): void
    {
        $sortBy = $this->input('sort');

        if (Arr::has($this->allowedSortings, $sortBy)) {
            $this->merge(['sort' => Arr::get($this->allowedSortings, $sortBy)]);
        } else {
            $this->merge(['sort' => ['created_at', 'desc']]);
        }
    }
}
