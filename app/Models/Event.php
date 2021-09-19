<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'event_title',
        'event_description',
        'event_date',
        'event_place',
        'event_picture.*',

    ];

    //Create relation from user table to event table
    public function user() {
        return $this->hasOne(User::class, 'id','user_id');
    }
    //Create relation from eventpic table to event table
    public function eventpic() {
        return $this->hasMany(EventPic::class , 'event_id' ,'id');
    }

}
