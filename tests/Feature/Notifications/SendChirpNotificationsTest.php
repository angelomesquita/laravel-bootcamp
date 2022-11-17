<?php 

namespace Tests\Feature\Notifications;

use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\{Factories, TestCase};

class SendChirpCreatedNotificationsTest extends TestCase
{
    use Factories;
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->getUser();
    }

    public function testShouldSendNotificationOnCreationEndpointCall(): void
    {
        Notification::fake();
        $anotherUser = $this->getUser();
        $data = ['message' => 'chirp created testing'];
        $this->actingAs($this->user)->postJson('/chirps', $data);
        Notification::assertSentTo([$anotherUser], NewChirp::class);
    }

    public function testShouldSendNotificationInInstancePersistence(): void
    {
        Notification::fake();
        $anotherUser = $this->getUser();
        $this->user->chirps()->create(['message' => 'testing send notification']);
        Notification::assertSentTo([$anotherUser], NewChirp::class);
    }

    public function testIfChirpOwnerDoesNotReceiveNotification(): void
    {
        Notification::fake();
        $this->user->chirps()->create(['message' => 'testing send notification']);
        Notification::assertNotSentTo([$this->user], NewChirp::class);
    }
}
