<?php

namespace Tests\Feature\Chirp;

use App\Models\Chirp;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\{Factories, TestCase};

class ChirpTest extends TestCase
{
    use Factories;
    use RefreshDatabase;

    private Chirp $chirp;

    public function setUp(): void
    {
        parent::setUp();
        $user = $this->getUser();
        $this->chirp = $this->getChirp($user);
    }

    public function testShouldCreateChirp(): void
    {
        $this->assertDatabaseHas('chirps', ['id' => $this->chirp->id]);
    }

    public function testShouldListChirp(): void
    {
        $chirps = Chirp::all();
        $firstChirp = $chirps->first();
        $this->assertInstanceOf(Collection::class, $chirps);
        $this->assertEquals($this->chirp->id, $firstChirp->id);
        $this->assertEquals($this->chirp->message, $firstChirp->message);
    }

    public function testShouldUpdateChirp(): void
    {
        $oldData = ['id' => $this->chirp->id, 'message' => $this->chirp->message];
        $this->chirp->update(['message' => 'message updated']);
        $data = ['id' => $this->chirp->id, 'message' => 'message updated'];
        $this->assertDatabaseMissing('chirps', $oldData);
        $this->assertDatabaseHas('chirps', $data);
    }

    public function testShouldDeleteChirp(): void
    {
        $data = ['id' => $this->chirp->id, 'message' => $this->chirp->message];
        Chirp::destroy($this->chirp->id);
        $this->assertDatabaseMissing('chirps', $data);
    }
}