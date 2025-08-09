<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillDownload extends Model
{
    protected $table = 'tmbill_download';

    public $timestamps = false;

    protected $fillable = [
        0 => 'link',
        1 => 'version',
    ];
}
