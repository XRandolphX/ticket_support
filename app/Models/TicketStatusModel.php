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
        'estado',
    ];

    public function setIdTicket()
    {
        return $this->belongsTo(TicketModel::class, 'estado_id', 'id');
    }
}
