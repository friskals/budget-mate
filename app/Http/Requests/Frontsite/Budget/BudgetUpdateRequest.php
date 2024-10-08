<?php

namespace App\Http\Requests\Frontsite\Budget;

use Illuminate\Foundation\Http\FormRequest;

class BudgetUpdateRequest extends FormRequest
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
            'name' => 'nullable|min:3',
            'limit' => 'nullable|numeric',
            'day_of_month' => 'nullable|numeric',
            'category_id' => 'nullable'
        ];
    }
}
