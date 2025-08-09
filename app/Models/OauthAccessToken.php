<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    protected $table = 'oauth_access_tokens';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['user_id', 'client_id', 'name', 'scopes', 'revoked', 'created_at', 'updated_at', 'expires_at'];
}
