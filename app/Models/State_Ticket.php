<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class State_Ticket extends Model
{
    use HasFactory;

    protected $table = 'state_ticket';

    protected $fillable = [
        'id',
        'estado',
    ];

    public function setIdTicket()
    {
        return $this->belongsTo(Ticket::class, 'estado_id', 'id');
    }
}
