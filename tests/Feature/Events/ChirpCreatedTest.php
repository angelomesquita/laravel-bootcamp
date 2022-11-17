<?php

namespace Tests\Feature\Events;

use App\Events\ChirpCreated;
use App\Models\Chirp;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\{Factories, TestCase};

class ChirpCreatedTest extends TestCase
{
    use Factories;
    use RefreshDatabase;

    public function testShouldReturnAPrivateChannelInstance(): void
    {
        $user = $this->getUser();
        $chirp = $this->getChirp($user);
        $chirpCreated = new ChirpCreated($chirp);
        $this->assertInstanceOf(PrivateChannel::class, $chirpCreated->broadcastOn());
        $this->assertEquals('private-channel-name', $chirpCreated->broadcastOn());
    }

    public function testShouldChirpCreatedIsDispatched(): void
    {
        Event::fakeFor(function () {
            $user = $this->getUser();
            $chirp = Chirp::factory()->create(['user_id' => $user->id]);
            Event::assertDispatched(ChirpCreated::class);
            return $chirp;
        });
    }
}