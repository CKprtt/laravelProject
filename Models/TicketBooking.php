<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketBooking extends Model {
    use SoftDeletes;
    protected $primaryKey = 'bookings_id';

    public function user() { return $this->belongsTo(User::class,'users_id'); }
    public function zone() { return $this->belongsTo(HallZone::class,'zones_id'); }
    public function event() { return $this->belongsTo(Event::class,'events_id'); }
}
