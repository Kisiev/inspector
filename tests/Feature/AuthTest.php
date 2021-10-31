<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Modules\Auth\Constants\VerificationStatus;
use Modules\Auth\Models\Verification;
use Modules\Notification\Events\EmailSendEvent;
use Modules\User\Models\User;

class AuthTest extends AbstractBaseTest
{
    use RefreshDatabase;

    public function testVerificationEmail()
    {
        Event::fake();
        $response = $this->json('POST', route('verification.send'));
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'type']);
        
        $response = $this->json('POST', route('verification.send'), [
            'type' => 'email',
            'email' => self::DEFAULT_EMAIL
        ]);
        $response->assertStatus(200);
        $data = $response->decodeResponseJson()->json();
        $this->assertDatabaseHas('verifications', [
            'token' => $data['data']['token']
        ]);
        Event::assertDispatched(EmailSendEvent::class);
    }
    
    public function testVerify()
    {
        $response = $this->json('GET', route('verification.verify'));
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['token', 'code', 'type']);

        /** @var Verification $verification */
        $verification = $this->createVerification();

        $response = $this->json('GET', route('verification.verify'), [
            'type' => 'email',
            'code' => $verification->code,
            'value' => $verification->value,
            'token' => $verification->token
        ]);

        $response->assertStatus(200);
        
        $response->assertJsonFragment(
            [
                'data' => [
                    'verification' => $verification->id
                ]
            ]
        );
    }
    
    public function testRegister()
    {
        $response = $this->json('POST', route('register'));
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'password', 'password_confirmation', 'verification', 'email']);

        /** @var Verification $verification */
        $verification = $this->createVerification();
        $verification->status = VerificationStatus::STATUS_CONFIRM;
        $verification->save();

        $response = $this->json('POST', route('register'), [
            'name' => 'FIO',
            'password' => self::DEFAULT_PASSWORD,
            'password_confirmation' => self::DEFAULT_PASSWORD,
            'verification' => $verification->id,
            'email' => $verification->value
        ]);

        $data = $response->decodeResponseJson()->json();

        $response->assertStatus(200);
        $this->assertArrayHasKey('user', $data['data']);
    }
    
    public function testAuth()
    {
        $response = $this->json('POST', route('login'));
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password', 'email']);

        /** @var User $user */
        $user = $this->createUser();

        $response = $this->json('POST', route('login'), [
            'email' => $user->email,
            'password' => self::DEFAULT_PASSWORD
        ]);

        $data = $response->decodeResponseJson()->json();

        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $data['data']);
    }
}
