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

    public function User() {
        return $this->belongsTo(User::class, 'questioners_id', 'id');
    }
    public function Answers() {
        return $this->hasMany(Answer::class, 'question_number', 'question_number');
    }
}
