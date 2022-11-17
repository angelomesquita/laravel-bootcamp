<?php

namespace Tests;

use App\Models\{Chirp, User};

trait Factories
{
    private function getUser(): User
    {
        return User::factory()->create();
    }

    private function getChirp(User $user): Chirp
    {
        return Chirp::factory()->create(['user_id' => $user->id]);
    }
}