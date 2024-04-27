<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //Возвращает коллекцию всех ролей.
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    //Создает новую роль.
    public function store(RoleRequest $request)
    {
        return Role::create($request->validated());
    }

    //Возвращает информацию о конкретной роли.
    public function show(Role $role)
    {
        return $role;
    }

    //Обновляет информацию о конкретной роли.
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return $role;
    }

    //Удаляет роль.
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json();
    }
}
