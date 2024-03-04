<?php

namespace Tests\Feature;


use App\Models\Department;
use App\Models\Resolver;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminStatsControllerTest extends TestCase
{
    use RefreshDatabase;

public function test_fetch_data_by_admin()
    {

        $this->withoutExceptionHandling();
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $user = User::factory()->create([
            'role' => 'user',
        ]);
        
        $this->actingAs($admin, 'sanctum' );

        $department = Department::factory()->create([
            'name' => 'Technical'
        ]);

        Ticket::factory()->create([
            'status' => 'pending',
            'department_id' => $department->id,
            'user_id' => $user->id
        ]);



        $response = $this->get('/api/admin/data'); // Adjust the route as needed


        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'type' => 'admin stats',
                    'attributes' => [
                        'count' => [
                            'tickets' => [
                                'pending' => 1,
                                'resolved' => 0,
                                'rejected' => 0,
                                'processing' => 0
                            ],
                            'users' => [
                                'all_user' => 2,
                                'resolver' => 0,
                                'department' => 1,
                                'clean_user' => 1,
                                'admin' => 1
                            ]
                        ],
                        'stats' => [
                            'yearly' => [
                                'created' => array (
                                                3 =>
                                                array (
                                                  'ticket_count' => 1,
                                                ),
                                              ),
                                              'resolved' => array ()
                            ],
                            'weekly' => [
                                'created' =>
                                       array (
                                         'Monday' =>
                                         array (
                                           'ticket_count' => 1,
                                         ),
                                       ),
                                       'resolved' =>
                                       array (),
                            ]
                        ]
                    ]
                ]
            ]);
    }

    public function test_fetch_resolvers_by_admin()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'role' => 'resolver'
        ]);

        $department = Department::factory()->create([
            'name' => 'Security'
        ]);

        $resolver = Resolver::factory()->create([
            'department_id' => $department->id,
            'user_id' => $user->id
        ]);

        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        
        $this->actingAs($admin, 'sanctum' );

        $response = $this->get('/api/admin/resolvers');

        $response->assertStatus(200)
                 ->assertJson([

                    'data' => [

                        [
                            'data' => [
                                'type' => 'resolvers',
                                'resolver_id' => 1,
                                'attributes' => [
                                    "user" => $user->name,
                                    "department" => $department->name,
                                    "counts" => [
                                        'resolved_tickets' => 0,
                                        'rejected_tickets' => 0,
                                        'processing_tickets' => 0
                                        ]
                                ]
                            ]
                        ]
                    ]
        ]);
    }
}


