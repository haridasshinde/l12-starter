<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAuthCode extends Model
{
    protected $table = 'oauth_auth_codes';

    public $timestamps = false;

    protected $fillable = [
        0 => 'user_id',
        1 => 'client_id',
        2 => 'scopes',
        3 => 'revoked',
        4 => 'expires_at',
    ];
}
