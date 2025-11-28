<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $guarded = [];

    public function mentor()
    {
        return $this->hasMany(Mentor::class);
    }

    public function intern()
    {
        return $this->hasMany(Intern::class);
    }
}
