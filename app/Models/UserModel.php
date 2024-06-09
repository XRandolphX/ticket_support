<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //Definiendo la tabla que debe usar el modelo.
    protected $table = 'users';
    // Campos que serán asignados de manera masiva.
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        // 'username',
        'password',
        'user_department_id',
        'user_status_id',
    ];
    // Se ocultan los campos cuando se convierte el modelo a un array o JSON.
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // Laravel convierte a una instancia datetime cuando accedo a este email_verified_at.
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //La nomenclatura debe ser esta: set- nombre del atributo - attribute. Lo usa Eloquent con Laravel para hacer el cambio en la base de datos.
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // RELACIONES FORÁNEAS DE LA TABLA USERS CON OTRAS
    // Muchos a muchos - Relación de este Modelo Usuario con el Modelo Rol de Usuario.
    public function user_roles()
    {
        return $this->belongsToMany(UserRoleModel::class);
    }

    // Uno a muchos - de este Modelo Usuario con el Modelo Ticket.
    public function ticket_user()
    {
        return $this->hasMany(TicketModel::class);
    }
}
