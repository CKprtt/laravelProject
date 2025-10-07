<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'events_id';
    protected $fillable = [
        'events_name',
        'description',
        'poster_path',
        'start_date',
        'end_date',
        'type_hall',
    ];

    public function eventRequests()
    {
        return $this->hasMany(EventRequest::class, 'events_id', 'events_id');
    }

    public function ticketBookings()
    {
        return $this->hasMany(TicketBooking::class, 'events_id', 'events_id');
    }
}