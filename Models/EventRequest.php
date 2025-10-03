<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventRequest extends Model
{
    use SoftDeletes;

    protected $table = 'event_requests'; 
    protected $primaryKey = 'event_requests_id';

    protected $fillable = [
        'event_name',
        'proposal',
        'start_date',
        'end_date',
        'event_status',
        'poster_path',
        'type_hall',
        'artist_id',
        'events_id',
    ];

    // ความสัมพันธ์กับศิลปิน
    public function artist()
    {
        return $this->belongsTo(ArtistProfile::class, 'artist_id', 'artist_id');
    }

    // ความสัมพันธ์กับอีเวนต์
    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id', 'events_id');
    }
}
