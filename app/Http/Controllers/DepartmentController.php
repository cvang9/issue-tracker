<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentResourceCollection;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    
    public function index()
    {
        $departments = Department::all();
        return new DepartmentResourceCollection($departments);
    }

    public function show($department_id)
    {
        $department = Department::findOrFail($department_id);
        return new DepartmentResource($department);
    }

    public function store()
    {
        $validated = request()->validate([
            'department' => 'required'
        ]);

        $department = Department::create([
            'name' => $validated['department']
        ]);

        return response([
                'success' => 'Successfully created department',
                'department_id' => $department->id  
            ], 201 );
    }

    public function update( )
    {

        $validated = request()->validate([
            'department' => 'required',
            'name' => 'required'
        ]);

        $department = Department::where( 'name', '=',  $validated['department'] )->first();

        $department->update([
            'name' => $validated['name']
        ]);

        return response([
            'success' => 'Updated a department successfully'
        ], 200 );

    }

    public function destroy()
    {
        $value = request();
        $validated = request()->validate([
            'department' => ''
        ]);

        

        $department = Department::where( 'name', '=',  $validated['department'] )->first();

        $department->delete();

        return response([
            'success' => 'Deleted a department successfully'
        ], 200 );
    }
}
