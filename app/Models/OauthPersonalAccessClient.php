<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OauthPersonalAccessClient extends Model
{
    use HasFactory;

    protected $table = 'oauth_personal_access_clients';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['client_id', 'created_at', 'updated_at'];
}
