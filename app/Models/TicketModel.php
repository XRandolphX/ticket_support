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
        'subject',
        'description',
        'user_id',
        'ticket_status_id',
        'ticket_priority_id',
    ];

    // Relaciones foráneas de la tabla Tickets con otras.
    
    // Uno a muchos 
    public function ticket_status()
    {
        return $this->belongsTo(TicketStatusModel::class);
    }
}
