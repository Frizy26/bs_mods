<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    public function store(RoleRequest $request)
    {
        return Role::create($request->validated());
    }

    public function show(Role $role)
    {
        return $role;
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return $role;
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json();
    }
}
