<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['submit_file', 'assigned_id'];

    public function assignment() {
    return $this->belongsTo('App\Assignment', 'assigned_id', 'id');
    }
}
