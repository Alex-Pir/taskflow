<?php

namespace App\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseApiRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    abstract public function rules(): array;
}
