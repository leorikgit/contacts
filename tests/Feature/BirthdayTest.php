<?php

namespace Tests\Feature;

use App\Contact;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BirthdayTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function Birthdays_can_be_retrieve(){
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $birthday = factory(Contact::class)->create(['user_id' => $user->id, 'birthday' => now()->subYear()]);
        $contact = factory(Contact::class)->create(['user_id' => $user->id, 'birthday' => now()->subMonth()]);

        $response = $this->get('/api/birthdays?api_token='. $user->api_token )->assertStatus(200);
        $response->assertJson([

                 'data' => [
                    [
                        'data'=> [
                            'contact_id' => $birthday->id
                        ]
                    ],
                 ],
                 'contact_count' => $this->count(),
                 'links' => [
                     'self' => url('/contacts')
                 ]

        ]);

    }
}

