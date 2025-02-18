<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_datetime' => 'required|date',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|size:2',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'complement' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20'
        ];
    }
}
