<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_fetching_all_tickets()
    {

        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $department = Department::factory()->create([
            'name' => 'Security'
        ]);

        $this->actingAs($user, 'sanctum' );

        $ticket1 = Ticket::factory()->create([
            'user_id' => $user->id,
            'department_id' => $department->id
        ]);

        $ticket2 = Ticket::factory()->create([
            'user_id' => $user->id,
            'department_id' => $department->id
        ]);

        $response = $this->get('/api/tickets');

        $response->assertStatus(200)
                 ->assertJson([

                    'data' => 
                    [
                    [
                        'data' => [
                            'type' => 'tickets',
                            'ticket_id' => $ticket2->id,
                            'attributes' => [
                                'title' => $ticket2->title,
                                'body' => $ticket2->body,
                                'status' => $ticket2->status,
                                'feedback' => '',
                                'resolver' => '',
                                'created_at' => $ticket2->created_at->diffForHumans()
                            ],
                        ],
                        
                        'data' => [
                            'type' => 'tickets',
                            'ticket_id' => $ticket1->id,
                            'attributes' => [
                                'title' => $ticket1->title,
                                'body' => $ticket1->body,
                                'status' => $ticket1->status,
                                'feedback' => '',
                                'resolver' => '',
                                'created_at' => $ticket1->created_at->diffForHumans()
                            ],
                        ],
                    ]
                    ]
                ]);
    }

    public function test_fetch_all_user_ticket() 
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $this->actingAs($user, 'sanctum' );
        
        $department = Department::factory()->create([
            'name' => 'Security'
        ]);
        
        $ticket2 = Ticket::factory()->create([
            'user_id' => $user->id,
            'department_id' => $department->id
        ]);

        $response = $this->get('/api/users/' . $user->id . '/tickets');
        
        $response->assertStatus(200);

        $response->assertJson([

            'data' => 
            [
            [
                'data' => [
                    'type' => 'tickets',
                    'ticket_id' => $ticket2->id,
                    'attributes' => [
                        'title' => $ticket2->title,
                        'body' => $ticket2->body,
                        'status' => $ticket2->status,
                        'feedback' => '',
                        'resolver' => '',
                        'created_at' => $ticket2->created_at->diffForHumans()
                    ],
                ]
            ]
            ]
        ]);
    }

    public function test_store_a_ticket()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $department = Department::factory()->create([
            'name' => 'Security'
        ]);

        $this->actingAs($user, 'sanctum' );

        $response = $this->post('/api/users/'. $user->id .'/tickets', [
            'title' => "A new issue",
            'body' => 'Here is the new body',
            'department' => 'Security'
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_a_ticket()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'role' => 'user'
        ]);
        
        $this->actingAs($user, 'sanctum' );

        $department = Department::factory()->create([
            'name' => 'Security'
        ]);


        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
            'department_id' => $department->id
        ]);

        $response = $this->delete('/api/users/'.$user->id.'/tickets/'.$ticket->id);

        $response->assertStatus(201);

    }

    public function test_show_a_ticket()
    {

        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $department = Department::factory()->create([
            'name' => 'Management'
        ]);


        $ticket2 = Ticket::factory()->create([
            'user_id' => $user->id,
            'department_id' => $department->id
        ]);
        
        $this->actingAs($user, 'sanctum' );

        $response = $this->get('/api/tickets/'. $ticket2->id );

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'type' => 'tickets',
                'ticket_id' => $ticket2->id,
                'attributes' => [
                    'title' => $ticket2->title,
                    'body' => $ticket2->body,
                    'status' => $ticket2->status,
                    'feedback' => '',
                    'resolver' => '',
                    'created_at' => $ticket2->created_at->diffForHumans()
                ],
            ]
        ]);


    }
}
