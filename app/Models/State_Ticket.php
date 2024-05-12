<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class State_Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'estado',
    ];

    public function setTicketState()
    {
        return $this->hasMany(Ticket::class, 'estado_id', 'id');
    }
}
