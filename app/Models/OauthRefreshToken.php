<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthRefreshToken extends Model
{
    protected $table = 'oauth_refresh_tokens';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['access_token_id', 'revoked', 'expires_at'];
}
