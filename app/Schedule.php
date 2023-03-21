<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'id',
        'content',
        'user_id',
        'subject',
        'scheduled_time'
    ];
}
