<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $guarded = [];

    public function intern()
    {
        return $this->belongsTo(Intern::class);
    }
    
    public function images()
    {
        return $this->hasMany(LogbookImage::class);
    }
}
