<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Title;
use App\User;

class Timetable extends Model
{
    protected $fillable = ['user_id','title_id','day','start','end','place','shop_name','mailmap','map','flg','name','email','member','memo','email_flg'];
           
    public function user(){
        return $this->belongsto(User::class);
    }

    public function title(){
        $this->belongsTo(Title::class);
    }

}
