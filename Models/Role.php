<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model {
    use SoftDeletes;
    protected $primaryKey = 'roles_id';

    public function users() {
        return $this->belongsToMany(User::class, 'user_has_roles', 'roles_id', 'users_id');
    }
}
