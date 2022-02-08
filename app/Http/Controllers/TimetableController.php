<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Timetable;
use App\Title;
use App\User;
use Yasumi\Yasumi;
use App\Library\Calendar;
use Auth;
use Mail;
use App\Mail\Reserve_SendMail;
use App\Mail\Reserve_User_SendMail;

use App\Mail\Reply_SendMail;
use App\Mail\Reply_User_SendMail;

use App\Mail\Cancel_SendMail;
use App\Mail\Cancel_User_SendMail;

class TimetableController extends Controller
{
    public function index(Request $request){
        $user=Auth::user();       
        if($request->has('day')){
            $today= new Carbon($request->day);
            $date=$today->copy()->firstOfMonth();            
        }else{
            $date=Carbon::now()->copy()->firstOfMonth();
        }
        $start=$date->copy()->firstOfMonth();
        $common = new Calendar();
        $ymd= $common->days($date,1);

        $end=$start->copy()->lastOfMonth();
        $prev = $start->copy()->subMonth();
        $next = $start->copy()->addMonth();
        $timetable=Timetable::leftJoin('titles', 'timetables.title_id', '=', 'titles.id')
           ->select('timetables.*', 'titles.name as title_name')
           ->whereBetween('timetables.day', [$start, $end])->orderby('timetables.day')->orderby('timetables.start')->get();
        $title_name=Title::where('user_id',$user->id)->orderby('id')->get();
        
        return view('timetables.timetable',compact('ymd','start','prev','next','title_name','timetable','user'));
    }

    public function store(Request $request){
        
        if($request->btn =='Email作成'){
            $param=[
                'id' => $request->id,
                'title_id' => $request->title_id,
                'day' => $request->day,
                'start' => $request->start,
                'end' => $request->end,
                'place' => $request->place,
                'shop_name' => $request->shop_name,
                'mailmap' => $request->mailmap,
                'map' => $request->map,
                'name' => $request->name,
                'email' => $request->email,
                'member' => $request->member,
                'memo' => $request->memo
            ];
            return redirect()->to('reply/?param='.encrypt($param));
        }
        if($request->btn =='キャンセル'){
            $tt=Timetable::find($request->id);
            $tt -> place = null;
            $tt -> shop_name = null;
            $tt -> mailmap = null;
            $tt -> map = null;
            $tt -> name = null;
            $tt -> email = null;
            $tt -> member = null;
            $tt -> memo = null;
            $tt -> flg = null;
            $tt -> mail_flg = null;
            $tt ->save();
            session()->flash('flash_message', '更新完了しました');
        }
        if($request->id == null){
            unset($request['btn']);
            $tt =new Timetable;
            $tt->fill($request->all())->save();
            session()->flash('flash_message', '登録完了しました');
        }else{
            $tt=Timetable::find($request->id);
            $tt->fill($request->all())->save();
            session()->flash('flash_message', '更新完了しました');
        }
        return redirect('/time_table');
    }
    public function reserve(Request $request){
           
            $tt=Timetable::find($request->id);
            $tt->fill($request->all())->save();
            //予約完了mail送信
            $data = Timetable::find($request->id); 
            $user = User::where('id',$data->user_id)->first();   
            Mail::to($request->email)->send(new Reserve_SendMail($data,$user));
            Mail::to($user->email)->send(new Reserve_User_SendMail($data,$user));
        return view('reserve.thanks',compact('request','user'));
    }

    /*
    予約に対しユーザーが予約者に返信する場合のemail作成画面表示
    */
    public function reply(Request $request)
    {
        
        $request = decrypt($request->param);
        $title=Title::find($request['title_id'])->name;
        $user=Auth::user();
        return view('reply.reply',compact('request','title','user'));
    }
    /*
    予約に対しユーザーが予約者に返信する場合のemail送信
    */
    public function reply_send(Request $request)
    {
        $tt=Timetable::find($request->id);
        $tt->fill($request->all())->save();
        $user=Auth::user();
        //mail送信
        $data = $request->all();     
        Mail::to($request->email)->send(new Reply_SendMail($data,$user));
        Mail::to(Auth::user()->email)->send(new Reply_User_SendMail($data,$user));
        $tt=Timetable::find($request->id);
        $tt->mail_flg = $tt->mail_flg+1;
        $tt->save();
        return view('emails.reply.complete',compact('user'));
    }
    /*
    キャンセルのemail送信
    */
    public function cancel(Request $request){
        $Param = decrypt($request->param);
        $data=TimeTable::find($Param['id']);
        
        if($data->email == null){
                return view('error_message');
        }else{
            if($data->email <> $Param['email']){
                return view('error_message');
            }
        }
        
        $date=new Carbon($data->day);
        
        if($date->isToday()){
            //当日キャンセルは受付ない
            return view('cancel.rejection',compact('data'));
        }else{
            $tt=Title::where('id',$data->title_id)->get();
            $title =$tt[0]->name;   
            return view('cancel.cancel',compact('data','title'));
        }
        
    }
    public function cancel_complete(Request $request){
             
        $data=TimeTable::find($request->id);
        $user = User::where('id',$data->user_id)->first();  
        $tt=Title::where('id',$data->title_id)->get();
        $title =$tt[0]->name;
        Mail::to($request->email)->send(new Cancel_SendMail($data,$title,$user));
        Mail::to($user[0]->email)->send(new Cancel_User_SendMail($data,$title,$user));
        $data->flg =2;
        $data->save(); 
        
        return view('cancel.complete',compact('user'));
    }

    public function cancel_sample(){
        return view('cancel.cancel_sample');
    }
    public function rejection_sample(){
        return view('cancel.rejection_sample');
    }
    public function error_message(){
        return view('error_message');
    }
    
}
