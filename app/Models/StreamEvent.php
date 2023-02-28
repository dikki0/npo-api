<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamEvent extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'event_id',
        'media_id',
        'user_id',
        'timestamp',
        'date_time',
        'event_type',
    ];

}
