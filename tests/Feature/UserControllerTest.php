<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_fetch_all_users()
    {

        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $this->actingAs($user, 'sanctum' );

        $response = $this->get('/api/users');

        $response->assertStatus(200)
                 ->assertJson(
                    [
                        'data' => [
                            [

                                'data' => [
                                    'type' => 'users',
                                    'user_id' => $user->id,
                                    'attributes' => [
                                        'name' => $user->name,
                                        'email' => $user->email,
                                        'role' => $user->role,
                                        'img' => $user->img ?? '',
                                        'created_at' => $user->created_at->diffForHumans(),
                                        ]
                                    ],
                                    'links' => [
                                        'self' => "/users/".$user->id
                                        ]
                            ]
                        ]

                    ]);
    }

    public function test_fetch_a_single_user()
    {

        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $this->actingAs($user, 'sanctum' );

        $response = $this->get('/api/users/'.$user->id);

        $response->assertStatus(200)
                 ->assertJson(
                    [
                        'data' => [
                            'type' => 'users',
                            'user_id' => $user->id,
                            'attributes' => [
                                'name' => $user->name,
                                'email' => $user->email,
                                'role' => $user->role,
                                'img' => $user->img ?? '',
                                'created_at' => $user->created_at->diffForHumans(),
                                ]
                            ],
                            'links' => [
                                'self' => "/users/".$user->id
                                ]
                    ]);

    }
}
