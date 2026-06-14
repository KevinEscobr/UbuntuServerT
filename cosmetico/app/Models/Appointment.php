<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['user_id', 'service', 'date', 'time', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
