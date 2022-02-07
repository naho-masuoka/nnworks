<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Timetable;

class Title extends Model
{
    protected $fillable = ['user_id','name'];


    public function user(){
        $this->belongsTo(Title::class);
    }
    
    public function timetables(){
        $this->hasMany(Timetable::class);
    }
}
