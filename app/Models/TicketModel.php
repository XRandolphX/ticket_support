<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TicketStatusModel;

class TicketModel extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'id',
        'usuario_id',
        'departamento_id',
        'asunto',
        'descripcion',
        'prioridad_id',
        'estado_id',
    ];

    // Relaciones foráneas de la tabla Tickets con otras.

    // Uno a muchos 
    public function setEstadoTicket()
    {
        return $this->belongsTo(TicketStatusModel::class, 'estado_id', 'id');
    }



    
}
