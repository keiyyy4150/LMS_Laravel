<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'assign_name',
        'explanation',
        'deadline',
        'course_id'
    ];

    public $timestamps = false;

    public function course() {
    return $this->belongsTo('App\Course', 'course_id', 'id');
    }
}
