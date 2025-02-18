<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'event_datetime',
        'name',
        'responsible',
        'city',
        'state',
        'address',
        'number',
        'complement',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
