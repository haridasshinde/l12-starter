<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    protected $table = 'oauth_clients';

    public $timestamps = false;

    protected $fillable = [
        0 => 'user_id',
        1 => 'name',
        2 => 'secret',
        3 => 'redirect',
        4 => 'personal_access_client',
        5 => 'password_client',
        6 => 'revoked',
        7 => 'created_at',
        8 => 'updated_at',
    ];
}
