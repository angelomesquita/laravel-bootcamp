<?php

namespace Tests\Unit\Policies;

use App\Models\Chirp;
use App\Models\User;
use App\Policies\ChirpPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChirpPolicyTest extends TestCase
{
    use RefreshDatabase;

    private $policy;
    private $chirp;
    private $user;
    private $anotherUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->policy = new ChirpPolicy();
        $this->user = $this->getUser();
        $this->anotherUser = $this->getUser();
        $this->chirp = $this->getChirp($this->user);
    }

    public function testShouldBeUpdateChirp(): void
    {
        $user = $this->chirp->user;
        $this->assertTrue($this->policy->update($user, $this->chirp));        
    }

    public function testShouldBeDeleteChirp(): void
    {
        $user = $this->chirp->user;
        $this->assertTrue($this->policy->delete($user, $this->chirp));        
    }

    public function testShouldDenyUpdateChirp(): void
    {
        $anotherUser = $this->anotherUser;
        $this->assertFalse($this->policy->update($anotherUser, $this->chirp));
    }

    public function testShouldDenyDeleteChirp(): void
    {
        $anotherUser = $this->anotherUser;
        $this->assertFalse($this->policy->delete($anotherUser, $this->chirp));
    }

    private function getUser(): User
    {
        return User::factory()->create();
    }

    private function getChirp(User $user): Chirp
    {
        return Chirp::factory()->create(['user_id' => $user->id]);
    }
}
