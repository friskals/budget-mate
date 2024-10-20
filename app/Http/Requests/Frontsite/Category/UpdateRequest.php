<?php

namespace App\Http\Requests\Frontsite\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['nullable','min:3'],
            'icon_id' => ['nullable', 'exists:icons,icon_id'],
            'name' => ['nullable', 'min:5'],
            'initial_balance' => ['nullable','numeric']
        ];
    }
}
