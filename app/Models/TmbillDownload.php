<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillDownload extends Model
{
    protected $table = 'tmbill_download';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['link', 'version'];
}
