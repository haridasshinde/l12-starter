<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['name', 'email', 'email_verified_at', 'password', 'remember_token', 'profile_photo_path', 'created_at', 'updated_at'];
}
