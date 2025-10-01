<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SouvenirOrder extends Model {
    use SoftDeletes;
    protected $table = 'souvenir_orders';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['users_id','souvenirs_id','quantity'];

    public function user() { return $this->belongsTo(User::class,'users_id'); }
    public function souvenir() { return $this->belongsTo(Souvenir::class,'souvenirs_id'); }
}
