<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class TicketStatusModel extends Model
{
    use HasFactory;

    protected $table = 'ticket_status';

    protected $fillable = [
        'id',
        'status',
    ];

    // Relaciones foráneas de la tabla Tickets Status con otras.
    public function status_ticket()
    {
        return $this->hasMany(TicketModel::class, 'ticket_status_id', 'id');
    }
}
