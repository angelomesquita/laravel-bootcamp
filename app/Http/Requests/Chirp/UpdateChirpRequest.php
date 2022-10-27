<?php

namespace App\Http\Requests\Chirp;

class UpdateChirpRequest extends BaseChirpRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->chirp);
    }
}
