<?php

namespace App\Http\Requests\Chirp;

use Illuminate\Foundation\Http\FormRequest;

class BaseChirpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message' => 'required|string|max:255',
        ];
    }
}
