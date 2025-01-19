<?php

namespace App\Http\Requests;

use App\Models\Car;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchRentalRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'plate_number' => [
                'required',
                'string',
                'exists:cars,plate_number',
                function ($attribute, $value, $parameters, $validator) {
                    $userId = $validator->getData()['user_id'];

                    $exists = Car::query()
                        ->where('plate_number', $value)
                        ->where('is_available', false)
                        ->whereHas('rentals', function ($query) use ($userId) {
                            $query->where('created_by_id', $userId);
                        })
                        ->exists();

                    if (!$exists) {
                        $validator->errors()->add($attribute, 'The selected car plate number is not valid for this user.');
                    }
                }
            ],
        ];
    }
}
