<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';

    public $timestamps = false;

    protected $fillable = [
        0 => 'email',
        1 => 'token',
        2 => 'created_at',
    ];
}
