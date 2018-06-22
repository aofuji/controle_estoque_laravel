<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles(){
        return $this->belongsToMany(\App\Models\Role::class);
    }
}
