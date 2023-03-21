<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationMessage extends Model
{
    protected $fillable = [
        'id',
        'notification_title',
        'notification_message',
        'notification_url',
        'user_id',
        'read_flg',
    ];
}
