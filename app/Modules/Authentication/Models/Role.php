<?php

namespace App\Modules\Authentication\Models;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    protected $table = 'roles';

    public $timestamps = false;
}
