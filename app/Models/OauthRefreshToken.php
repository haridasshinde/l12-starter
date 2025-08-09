<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthRefreshToken extends Model
{
    protected $table = 'oauth_refresh_tokens';

    public $timestamps = false;

    protected $fillable = [
        0 => 'access_token_id',
        1 => 'revoked',
        2 => 'expires_at',
    ];
}
