<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'user_id', 'contact', 'reasons', 'from', 'to', 'type', 'status'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
