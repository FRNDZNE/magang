<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intern extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }

    public function scoreValues()
    {
        return $this->hasMany(ScoreValue::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }


}
