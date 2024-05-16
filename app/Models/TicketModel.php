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
        'subject',
        'description',
        'user_id',
        'ticket_status_id',
        'ticket_priority_id',
    ];

    // Relaciones foráneas del Modelo Tickets con otras.


    // Uno a muchos - Del modelo Ticket al modelo User.
    public function ticket_user()
    {
        return $this->belongsTo(UserModel::class);
    }

    // Uno a muchos - Del modelo Ticket al modelo Tickets Status.
    public function ticket_status()
    {
        return $this->belongsTo(TicketStatusModel::class);
    }

    // Uno a muchos - Del modelo Ticket al modelo Tickets Priority.
    public function ticket_priority()
    {
        return $this->belongsTo(TicketPriorityModel::class);
    }
}
