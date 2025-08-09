<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteAdminLogin extends Model
{
    use HasFactory;

    protected $table = 'website_admin_login';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['username', 'password', 'col1', 'col2', 'col3', 'col4', 'col5'];
}
