<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_datetime' => 'sometimes|date',
            'name' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|size:2',
            'address' => 'sometimes|string|max:255',
            'number' => 'sometimes|string|max:10',
            'complement' => 'nullable|string|max:255',
            'phone' => 'sometimes|string|max:20'
        ];
    }
}
