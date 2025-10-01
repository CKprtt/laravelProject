<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserHasRole extends Model {
    use SoftDeletes;
    protected $table = 'user_has_roles';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['users_id','roles_id'];

    public function user() { return $this->belongsTo(User::class,'users_id'); }
    public function role() { return $this->belongsTo(Role::class,'roles_id'); }
}
