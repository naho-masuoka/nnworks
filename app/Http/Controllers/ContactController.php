<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;
use App\Title;
use App\User;
use Auth;
use Carbon\Carbon;
use Yasumi\Yasumi;
use App\Library\Calendar;
use App\Mail\Reservation_SendMail;
use App\Mail\Reservation_User_SendMail;
class ContactController extends Controller
{
    
    public function index(Request $request,$user_url){
        //$url=ltrim(url()->current(), 'http://localhost/home/');
        $url=ltrim(url()->current(), 'https://nnworks.herokuapp.com/home/');
        $user= User::where('url', $url)->first();
        
        $today= new Carbon($request->day);
        if($request->has('day')){            
            $date=$today->copy()->firstOfMonth();            
        }else{
            $date=Carbon::now()->copy()->firstOfMonth();
        }
        $start=$date->copy()->firstOfMonth();
        $common = new Calendar();
        $ymd= $common->days($date,2);

        $end=$start->copy()->lastOfMonth();
        $prev = $start->copy()->subMonth();
        $next = $start->copy()->addMonth();


        $reservation=Timetable::where('user_id',$user->id)
                ->whereBetween('day',[$today,$end])
                ->orderby('day')
                ->orderby('start')
                ->get();
        return view('calendar',compact('ymd','start', 'prev','next','reservation','user'));
    }

    
}