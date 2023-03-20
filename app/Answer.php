<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'id',
        'question_number',
        'answer_number',
        'answerers_id',
        'answer',
        'reference_matter',
    ];
}
