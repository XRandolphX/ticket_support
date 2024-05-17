<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\UserRoleModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SetRoleUserController extends Controller
{
    public function assignRole($user_id, $role_id)
    {
        try {
            $user = UserModel::find($user_id);
            $role = UserRoleModel::find($role_id);

            $user->user_roles()->attach($role);
        } catch (ModelNotFoundException $e) {
            Log::error('Error al asignar el rol: ' . $e->getMessage());
            // Redirigir a la vista o devolver una respuesta
        }
    }
}
