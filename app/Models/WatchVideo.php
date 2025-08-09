<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchVideo extends Model
{
    protected $table = 'watch_videos';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['title', 'link'];
}
