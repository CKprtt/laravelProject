<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Souvenir extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'souvenirs_id';

    public function users()
    {
        return $this->belongsToMany(User::class, 'souvenir_orders', 'souvenirs_id', 'users_id')
            ->withPivot('quantity')->withTimestamps();
    }
}
