<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

class UserRoleModel extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['role_name',];

    public function role_users()
    {
        return $this->belongsToMany(UserModel::class);
    }
}
