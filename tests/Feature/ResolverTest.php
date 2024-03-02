<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Resolver;
use App\Models\Ticket;
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
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'name' => 'name',
            'email' => 'email@mail.com',
            'password' => 'P4assword',
            'role' => 'resolver',
            'img' => 'file',
        ]);
        $department = Department::factory()->create([
            'name' => 'management',
        ]);
        $resolver = Resolver::factory()->create([
            'user_id' => $user->id,
            'department_id' => $department->id,
        ]);
        $this->assertCount(1, Resolver::all());
        $this->actingAs($user, 'sanctum');
        $response = $this->get('/api/resolvers/' . $resolver->id);
        $response->assertStatus(200);
    }

    //test case for updating ticket
    public function test_update_a_ticket_status(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'name' => 'name',
            'email' => 'email@mail.com',
            'password' => 'P4assword',
            'role' => 'resolver',
            'img' => 'file',
        ]);
        $anotherUser = User::factory()->create([
            'role' => 'user',
        ]);
        $department = Department::factory()->create([
            'name' => 'management',
        ]);
        $resolver = Resolver::factory()->create([
            'user_id' => $user->id,
            'department_id' => $department->id,
        ]);
        $ticket = Ticket::factory()->create([
            'body' => 'body',
            'status' => 'pending',
            'user_id' => $anotherUser->id,
            'department_id' => $department->id,
        ]);
        $this->actingAs($user, 'sanctum');
        $response = $this->get('/resolvers/' . $resolver->id . '/tickets/' . $ticket->id);
        $response->assertStatus(200);
    }
}
