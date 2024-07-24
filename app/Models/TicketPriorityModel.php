<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPriorityModel extends Model
{
    use HasFactory;

    protected $table = 'ticket_priority';

    protected $fillable = [
        'id',
        'ticket_priority_name',
    ];

    // Relación foránea del Modelo Ticket Priority con Ticket.

    // Uno a muchos - Del modelo Tickets Priority al modelo Ticket.
    public function priority_ticket()
    {
        return $this->hasMany(TicketModel::class, 'ticket_priority_id', 'id');
    }
}
