<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogbookImage extends Model
{
    protected $guarded = [];

    public function logbook()
    {
        return $this->belongsTo(Logbook::class);
    }
}
