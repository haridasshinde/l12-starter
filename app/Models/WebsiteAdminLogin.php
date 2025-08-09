<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteAdminLogin extends Model
{
    protected $table = 'website_admin_login';

    public $timestamps = false;

    protected $fillable = [
        0 => 'username',
        1 => 'password',
        2 => 'col1',
        3 => 'col2',
        4 => 'col3',
        5 => 'col4',
        6 => 'col5',
    ];
}
