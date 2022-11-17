<?php

namespace Tests\Feature\Chirp;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\{Factories, TestCase};

class CrudChirpTest extends TestCase
{
    use Factories;
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->getUser();
        $this->actingAs($this->user);
    }

    public function testShouldCreateChirp(): void
    {
        $data = ['message' => 'creating chirp'];
        $response = $this->postJson('/chirps', $data);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function testShouldListChirps(): void
    {
        $response = $this->getJson('/chirps');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testShouldDeleteChirp(): void
    {
        $chirp = $this->getChirp($this->user);
        $response = $this->deleteJson("/chirps/{$chirp->id}");
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function testShouldUpdateChirp(): void
    {
        $chirp = $this->getChirp($this->user);
        $data = ['message' => 'new message'];
        $response = $this->putJson("/chirps/{$chirp->id}", $data);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}