<?php

namespace App\Modules\Authentication\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    const UPDATED_AT = null;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }
}
