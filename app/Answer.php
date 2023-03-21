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

    public function User() {
        return $this->belongsTo(User::class, 'answerers_id', 'id');
    }
    public function Comments() {
        return $this->hasMany(AnswerComment::class, 'answer_number', 'answer_number');
    }
}
