<?php

namespace Tests\Feature;

use App\Contact;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }


    /** @test */
    public function unAuthenticated_user(){
        $response = $this->post('/api/contacts', array_merge($this->data(), ['api_token' => '']));
        $response->assertRedirect('/login');

        $this->assertCount(0, Contact::all());
    }

    /** @test */
    public function contact_can_be_added(){
        $this->withoutExceptionHandling();

        $this->post('/api/contacts', $this->data());

        $contacts = Contact::first();

        $this->assertEquals('test', $contacts->name);
        $this->assertEquals('test@gmail.com', $contacts->email);
        $this->assertEquals('06/01/1989', $contacts->birthday->format('m/d/Y'));
        $this->assertEquals('test', $contacts->company);

    }
    /** @test */
    public function fields_are_required(){

        collect(['name', 'email', 'birthday', 'company'])
            ->each(function ($field){

                $response = $this->post('/api/contacts', array_merge($this->data(), [$field => '']))->assertStatus(422);
                $contacts = Contact::first();

                $this->assertEquals(0, $contacts);
                $responseString = json_decode($response->getContent(), true);
                $this->assertArrayHasKey($field, $responseString['errors']['meta']);

            });
    }
    /** @test */
    public function email_must_be_valid(){

        $response = $this->post('/api/contacts', array_merge($this->data(), ['email' => 'this is not valid email address']));

        $responseString = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('email', $responseString['errors']['meta']);
        $this->assertEquals(0, Contact::first());
    }
    /** @test */
    public function birthday_must_be_valid(){
        $this->withoutExceptionHandling();
        $response = $this->post('/api/contacts', array_merge($this->data(), ['birthday' => 'June 01, 1989']));
        $contacts = Contact::first();

        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(Carbon::class, $contacts->birthday);
        $this->assertEquals('06-01-1989',$contacts->birthday->format('m-d-Y'));
    }
    /** @test */
    public function user_can_retrieve_only_his_contacts(){

        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $firstContact = factory(Contact::class)->create(['user_id' => $user->id]);
        $secondContact = factory(Contact::class)->create(['user_id' => $anotherUser->id]);

        $response = $this->get('/api/contacts'. '?api_token='. $user->api_token)
            ->assertStatus(200);


        $this->assertCount(1, $user->contacts);
        $response->assertJson([
            'data' => [
                [
                    'data' => [
                        'type' => 'contacts',
                        'contact_id' => $user->contacts->first()->id,
                        'attributes' => [
                            'name' =>  $user->contacts->first()->name,
                            'email' =>  $user->contacts->first()->email,
                            'birthday' =>  $user->contacts->first()->birthday->format('m/d/Y'),
                            'company' =>  $user->contacts->first()->company,
                        ],
                    ],
                    'links' => [
                        'self' => url('/contacts/'.$user->contacts->first()->id)
                    ]
                ],

            ],
            'links' => [
                'self' => url('/contacts')
            ]
        ]);

    }
    /** @test */
    public function single_contact_can_be_retrieved(){

        $contact = factory(Contact::class)->create(['user_id'=> $this->user->id]);

        $response = $this->get('/api/contacts/'.$contact->id .'?api_token='.$this->user->api_token )
        ->assertStatus(200);

        $response->assertJson([
            'data' => [
                'type' => 'contacts',
                'contact_id' => $contact->id,
                'attributes' => [
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'birthday' => $contact->birthday->toJSON(),
                    'company' => $contact->company
                ]
            ],
            'links' => [
                'self' => url('/contacts/'.$contact->id)
            ]
        ]);
    }
    /** @test */
    public function single_contact_can_be_retrieved_by_auth_user(){
        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $contact = factory(Contact::class)->create(['user_id' => $user->id]);

        $response = $this->get('/api/contacts/'.$contact->id .'?api_token='.$anotherUser->api_token )
            ->assertStatus(403);

    }

    /** @test */
    public function contact_does_not_exists(){
        $response = $this->get('/api/contacts/123'.'?api_token='.$this->user->api_token)
            ->assertStatus(404);
        $response->assertJson([
            'errors'=>[
                'code' => 404,
                'title' => 'Contact Not Found',
                'detail' => 'Unable to locate the Contact with the given information.'
            ]
        ]);
    }
    /** @test */
    public function contact_can_be_updated(){

        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);

        $response = $this->patch('/api/contacts/'.$contact->id, $this->data())->assertStatus(200);
        $contact = $contact->fresh();

        $this->assertEquals('test', $contact->name);
        $this->assertEquals('test@gmail.com', $contact->email);
        $this->assertEquals('06/01/1989', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('test', $contact->company);

        $response->assertJson([
            'data' => [
                'type' => 'contacts',
                'contact_id' => $contact->id,
                'attributes' => [
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'birthday' => $contact->birthday->toJSON(),
                    'company' => $contact->company
                ]
            ],
            'links' => [
                'self' => url('/contacts/'.$contact->id)
            ]
        ]);
    }
    /** @test */
    public function contact_can_be_updated_only_by_auth_user(){

        $anotherUser = factory(User::class)->create();

        $contact = factory(Contact::class)->create(['user_id'=> $this->user->id]);
        $response = $this->patch('/api/contacts/'.$contact->id, array_merge($this->data(), ['api_token' => $anotherUser->api_token]))->assertStatus(403);

    }

    /** @test */
    public function contact_can_be_deleted(){

        $contact = factory(Contact::class)->create(['user_id' => $this->user]);
        $response = $this->delete('/api/contacts/'.$contact->id, $this->data())->assertStatus(204);
        $this->assertCount(0, Contact::all());
        $response->assertNoContent();
    }
    /** @test */
    public function contact_can_be_deleted_only_bY_auth_user(){

        $anotherUser = factory(User::class)->create();

        $contact = factory(Contact::class)->create(['user_id' => $this->user]);
        $this->delete('/api/contacts/'.$contact->id, array_merge($this->data(), ['api_token' => $anotherUser->api_token]))->assertStatus(403);

    }

    private function data(){

        return [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'birthday' => '06/01/1989',
            'company' => 'test',
            'api_token' => $this->user->api_token,
            'user_id' => $this->user->id
        ];
    }
}
