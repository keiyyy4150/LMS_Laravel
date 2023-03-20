<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'id',
        'question_number',
        'questioners_id',
        'subject',
        'category',
        'title',
        'question',
        'reference_matter',
        'status',
        'answer_deadline'
    ];
}
