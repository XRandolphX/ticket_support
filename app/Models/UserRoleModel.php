<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

class UserRoleModel extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(UserModel::class, 'user_roles');
    }
}
