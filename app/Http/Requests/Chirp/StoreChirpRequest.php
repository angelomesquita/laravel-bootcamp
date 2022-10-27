<?php

namespace App\Http\Requests\Chirp;

class StoreChirpRequest extends BaseChirpRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
