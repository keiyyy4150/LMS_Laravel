<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'images',
        'name',
        'kana',
        'tel',
        'email',
        'test_date',
        'course_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function schedule() {
        return $this->hasMany('App\Schedule');
    }

    public function submission() {
        return $this->hasMany('App\Submission');
    }

    public function Question() {
        return $this->hasMany(Question::class, 'id', 'questioners_id');
    }

    public function Answer() {
        return $this->hasMany(Answer::class, 'id', 'answerers_id');
    }
}

class Users extends Model
{
    //
}
