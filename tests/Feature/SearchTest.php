<?php

namespace Tests\Feature;

use App\Contact;
use App\Http\Resources\ContactCollection;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contacts_can_be_searched(){
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        factory(Contact::class)->create(['user_id' => $user->id]);
        factory(Contact::class)->create(['user_id' => $secondUser->id]);

        $response = $this->post('/api/search', ['api_token' => $user->api_token, 'searchTerm' => 'vidavi'])

            ->assertStatus(200);

    }
}
