<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id')->get();

        return response()->json([
            'status' => 'success',
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
            $role = Role::create($request->all());
    
            return response()->json([
                'status' => true,
                'message' => "Role Created successfully!",
                'roles' => $role
            ], 201);
    //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
            $role->find($role->id);
            if (!$role) {
                return response()->json(['message' => 'role not found'], 404);
            }
            return response()->json($role, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
            $role->update($request->all());
    
            if (!$role) {
                return response()->json(['message' => 'role not found'], 404);
            }
    
            return response()->json([
                'status' => true,
                'message' => "role Updated successfully!",
                'role' => $role
            ], 200);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
            $role->delete();
    
            if (!$role) {
                return response()->json([
                    'message' => 'role not found'
                ], 404);
            }
    
            return response()->json([
                'status' => true,
                'message' => 'role deleted successfully'
            ], 200);
        }
}
