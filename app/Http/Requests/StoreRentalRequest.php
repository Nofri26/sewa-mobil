<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentalRequest extends FormRequest
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
            'start' => ['required', 'date', 'after_or_equal:today'],
            'end' => ['required', 'date', 'after:start'],
            'cost' => ['required', 'numeric', 'min:0'],
            'car_id' => ['required', 'exists:cars,id'],
            'created_by_id' => ['required', 'exists:users,id'],
        ];
    }
}
