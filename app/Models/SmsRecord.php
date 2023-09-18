<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsRecord extends Model
{
    protected $fillable = [
    	'mobile', 'sms', 'send_by', 'sending_date', 'is_send', 'sms_count'
    ];
}