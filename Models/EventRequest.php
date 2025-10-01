<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventRequest extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'event_requests_id';

    // ✅ กำหนด field ที่ให้ assign ได้
    protected $fillable = [
        'event_name',
        'proposal',
        'start_date',
        'end_date',
        'event_status',
        'poster_path',
        'artist_id',
        'events_id',
    ];

    public function artist()
    {
        return $this->belongsTo(ArtistProfile::class,'artist_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class,'events_id');
    }
}