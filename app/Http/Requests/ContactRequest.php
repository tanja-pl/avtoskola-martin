<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:80'],
            'phone' => ['required', 'string', 'min:6', 'max:40'],
            'email' => ['nullable', 'email', 'max:120'],
            'subject' => ['nullable', 'string', 'max:80'],
            'message' => ['required', 'string', 'min:5', 'max:2000'],
            'website' => ['nullable', 'string', 'max:120'],
        ];
    }
}
