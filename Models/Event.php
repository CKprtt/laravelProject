<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model {
    use SoftDeletes;
    protected $primaryKey = 'events_id';

    public function eventRequests() { return $this->hasMany(EventRequest::class,'events_id'); }
    public function ticketBookings() { return $this->hasMany(TicketBooking::class,'events_id'); }
}
