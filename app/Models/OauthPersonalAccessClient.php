<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthPersonalAccessClient extends Model
{
    protected $table = 'oauth_personal_access_clients';

    public $timestamps = false;

    protected $fillable = [
        0 => 'client_id',
        1 => 'created_at',
        2 => 'updated_at',
    ];
}
