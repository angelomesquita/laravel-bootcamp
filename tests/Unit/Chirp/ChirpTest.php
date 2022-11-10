<?php

namespace Tests\Unit\Chirp;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class ChirpTest extends TestCase
{
    public function testUserIsABelongToRelationship(): void
    {
        $chirp = Chirp::factory()->make();
        $this->assertInstanceOf(BelongsTo::class, $chirp->user());
    }

    public function testUserNotInitializeShouldBeNull(): void
    {
        $chirp = Chirp::factory()->make();
        $this->assertNull($chirp->user);
    }

    public function testShouldReturnUser(): void
    {
        $chirp = Chirp::factory()->make();
        $user = User::factory()->make();
        $chirp->user = $user;
        $this->assertInstanceOf(User::class, $chirp->user);
        $this->assertEquals($user->name, $chirp->user->name);
    }
}
