<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title;
use Auth;
class TitlesController extends Controller
{
    public function index(){
        $user=Auth::user();
        $titles=Title::where('user_id',$user->id)->get();
        
        return view('titles.title',compact('titles','user'));
    }

    public function store_edit(Request $request){
        if($request->id == null){
            $t =new Title;            
        }else{
            $t=Title::find($request->id);
        }
        $t->fill($request->all())->save();
        return redirect('/title');
    }
}
