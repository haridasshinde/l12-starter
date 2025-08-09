<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAuthCode extends Model
{
    protected $table = 'oauth_auth_codes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'client_id', 'scopes', 'revoked', 'expires_at'];
}
