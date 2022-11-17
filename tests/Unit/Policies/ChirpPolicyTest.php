<?php

namespace Tests\Unit\Policies;

use App\Policies\ChirpPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\{Factories, TestCase};

class ChirpPolicyTest extends TestCase
{
    use Factories;
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
}
