<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistProfile extends Model {
    use SoftDeletes;
    protected $primaryKey = 'artist_id';

    public function user() { return $this->belongsTo(User::class,'users_id'); }
    public function eventRequests() { return $this->hasMany(EventRequest::class,'artist_id'); }
}
ดกกด
