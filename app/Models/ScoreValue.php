<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreValue extends Model
{
    protected $guarded = [];

    public function score()
    {
        return $this->belongsTo(Score::class);
    }

    public function intern()
    {
        return $this->belongsTo(Intern::class);
    }
}
