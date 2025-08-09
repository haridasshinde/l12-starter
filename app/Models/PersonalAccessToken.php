<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    protected $table = 'personal_access_tokens';

    public $timestamps = false;

    protected $fillable = [
        0 => 'tokenable_type',
        1 => 'tokenable_id',
        2 => 'name',
        3 => 'token',
        4 => 'abilities',
        5 => 'last_used_at',
        6 => 'created_at',
        7 => 'updated_at',
    ];
}
