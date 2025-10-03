<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HallZone extends Model {
    use SoftDeletes;
    protected $primaryKey = 'zones_id';

    public function ticketBookings() { return $this->hasMany(TicketBooking::class,'zones_id'); }
}
