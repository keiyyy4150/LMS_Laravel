<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function course() {
        return $this->belongsTo('App\User', 'course_id', 'id');
        }
}

