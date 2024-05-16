<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //La nomenclatura debe ser esta: set- nombre del atributo - Attribute. Lo usa Eloquent con Laravel para hacer el cambio en la base de datos.
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Relaciones foráneas de la tabla Users con otras.

    // Muchos a muchos
    public function user_roles()
    {
        return $this->belongsToMany(UserRoleModel::class);
    }





    // Uno a muchos
    public function user_tickets()
    {
        return $this->hasMany(TicketModel::class);
    }

    // Muchos a muchos
    public function user_status()
    {
        return $this->belongsToMany(UserStatusModel::class, 'user_status');
    }

    // Muchos a muchos
    public function user_department()
    {
        return $this->belongsToMany(UserDepartmentModel::class, 'user_department');
    }
}
