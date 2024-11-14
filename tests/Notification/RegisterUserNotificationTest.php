<?php

namespace Tests\Notification;

use App\Models\User;
use App\Notifications\UserRegisteredNotification; 
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegisterUserNotificationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that a notification is sent when a user registers.
     *
     * @return void
     */
    public function test_notification_is_sent_on_registration()
    {
       
        Notification::fake();
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $this->post(route('register'), $userData);

        Notification::assertSentTo(
            [User::where('email', 'test@example.com')->first()],
            UserRegisteredNotification::class 
        );
    }
}
