<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchVideo extends Model
{
    protected $table = 'watch_videos';

    public $timestamps = false;

    protected $fillable = [
        0 => 'title',
        1 => 'link',
    ];
}
