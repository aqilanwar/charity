<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
    ];

    protected $table='join';

}
