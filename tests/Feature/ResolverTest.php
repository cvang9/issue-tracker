<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResolverTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    // test case for fetch all resolvers

    public function test_fetch_all_resolver(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'role' => 'resolver',
        ]);
        $this->assertCount(1, User::all());
        $this->actingAs($user, 'sanctum');
        $response = $this->get('/api/resolvers');
        $response->assertStatus(200);
    }

    //test case for fetch a particular resolver
    public function test_fetch_a_particular_resolver(): void
    {

    }
}
