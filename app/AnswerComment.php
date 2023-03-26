<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    protected $fillable = [
        'id',
        'answer_number',
        'responders_id',
        'responds'
    ];
}
