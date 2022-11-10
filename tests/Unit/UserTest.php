<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testChirpsIsHasManyRelationship(): void
    {
        $user = User::factory()->make();
        $this->assertInstanceOf(HasMany::class, $user->chirps());
    }

    public function testChirpsShouldReturnAEloquentCollection(): void
    {
        $user = User::factory()->make();
        $this->assertInstanceOf(Collection::class, $user->chirps);
    }

    public function testUserHasChirp(): void
    {
        $message = 'testing...';
        $user = User::factory()->make();
        $chirp = $user->chirps()->make(['message' => $message]);
        $this->assertEquals($message, $chirp->message);
    }

}
