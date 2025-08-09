<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    protected $table = 'oauth_access_tokens';

    public $timestamps = false;

    protected $fillable = [
        0 => 'user_id',
        1 => 'client_id',
        2 => 'name',
        3 => 'scopes',
        4 => 'revoked',
        5 => 'created_at',
        6 => 'updated_at',
        7 => 'expires_at',
    ];
}
