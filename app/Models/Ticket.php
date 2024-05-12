<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State_Ticket;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'usuario_id',
        'departamento_id',
        'asunto',
        'descripcion',
        'prioridad_id',
        'estado_id',
    ];

    public function setTicketState()
    {
        return $this->belongsTo(State_Ticket::class);
    }
}
