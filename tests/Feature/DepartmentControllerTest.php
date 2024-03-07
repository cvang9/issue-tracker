<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Resolver;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_fetch_all_departments()
    {
        $this->withoutExceptionHandling();
        
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $user2 = User::factory()->create([
            'role' => 'user'
        ]);
        $user = User::factory()->create([
            'role' => 'user'
        ]);
        
        $this->actingAs($admin, 'sanctum' );

        $department = Department::factory()->create([
            'name' => 'Technical'
        ]);

        Resolver::factory()->create([
            'user_id' => $user->id,
            'department_id' => $department->id
        ]);

        Ticket::factory()->create([
            'user_id' => $user2->id,
            'department_id' => $department->id,
            'status' => 'pending'
        ]);

        $response = $this->get('/api/departments')
                         ->assertStatus(200)
                         ->assertJson(
                            [
                                'data' => [
                                    [
                                        'data' => [
                                            'type' => 'department',
                                            'department_id' => $department->id,
                                            'attributes' => [
                                                'name' => $department->name,
                                                'counts' => [
                                                    'issue' => 1,
                                                    'resolver' => 1,
                                                    'resolved_tickets' => 0,
                                                    'unresolved_tickets' => 1
                                                    ]
                                                ]
                                        ]
                                    ]
                                ]
                            ]
                        );
    }

    public function test_show_a_department()
    {

        $this->withoutExceptionHandling();

        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $this->actingAs($admin, 'sanctum' );

        $department = Department::factory()->create([
            'name' => 'Technical'
        ]);

        $response = $this->get('/api/departments/' . $department->id );

        $response->assertStatus(200);

        $response->assertJson([
                    'data' => [
                        'type' => 'department',
                        'department_id' => $department->id,
                        'attributes' => [
                            'name' => $department->name,
                            'counts' => [
                                'issue' => 0,
                                'resolver' => 0,
                                'resolved_tickets' => 0,
                                'unresolved_tickets' => 0
                                ]
                            ]
                    ]
        ]);
    }

    public function test_store_a_department()
    {

        $this->withoutExceptionHandling();

        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $this->actingAs($admin, 'sanctum' );

        $this->post('/api/departments', [
            'department' => 'GPS Tracking'
        ]);

        $response = $this->get('/api/departments');

        $response->assertStatus(200)
                 ->assertJson([
                    'data' => [
                        [
                            'data' => [
                                'type' => 'department',
                                'attributes' => [
                                    'name' => 'GPS Tracking',
                                    'counts' => [
                                        'issue' => 0,
                                        'resolver' => 0,
                                        'resolved_tickets' => 0,
                                        'unresolved_tickets' => 0
                                        ]
                                    ]
                            ]
                        ]
                    ]
                ]);

    }

    public function test_update_a_department()
    {

        $this->withoutExceptionHandling();

        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $this->actingAs($admin, 'sanctum' );

        $department = Department::factory()->create([
            'name' => 'GPS'
        ]);

        $response = $this->put('/api/departments', [
            'department' => 'GPS',
            'name' => 'GPS Team'
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'success' => 'Updated a department successfully'
        ]);
    }


    public function test_delete_a_department()
    {

        $this->withoutExceptionHandling();

        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $this->actingAs($admin, 'sanctum');

        $department = Department::factory()->create([
            'name' => 'GPS'
        ]);

        $delResponse = $this->put('/api/departments/delete', [
            'department' => 'GPS'
        ]);

        $delResponse->assertStatus(200);

    }

}
