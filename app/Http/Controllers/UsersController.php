<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use InterventionImage;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index(){
        $user=User::find(Auth::user()->id);
        return view('users.user',compact('user'));

    }
    public function update(Request $request){
        $pc=null;
        $sp=null;
        $user=User::find(Auth::user()->id);
            
        if($request->has('pc')){
            
            Storage::disk('public')->delete('/files/'.$user->pc);
            $file = $request->file('pc');
            $extension= $file->getClientOriginalExtension();        
            $pc=$user->id .'_pcheader.'.$extension;
            InterventionImage::make($file)
                ->fit(1200, 300, function ($constraint) {$constraint->aspectRatio();})
                ->save(public_path('/files/' . $pc));
        }
        if($request->has('sp')){
            Storage::delete('/files/'.$user->sp);           
            Storage::disk('public')->delete('/files/'.$user->sp);
            $file = $request->file('sp');
            $extension= $file->getClientOriginalExtension();
            $sp=$user->id .'_spheader.'.$extension;
            InterventionImage::make($file)
                ->fit(450, 150, function ($constraint) {$constraint->aspectRatio();})
                ->save(public_path('/files/' . $sp));
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->email_name=$request->email_name;
        $user->signature=$request->signature;
        $user->hp=$request->hp;
        $user->blog=$request->blog;
        $user->bg=$request->bg;
        $user->font=$request->font;
        if($request->has('pc')){
            $user->pc=$pc;
        }
        if($request->has('sp')){
            $user->sp=$sp;
        }
        $user->save();
        session()->flash('flash_message', '更新完了しました');    
        return redirect('/users');
        
    }
}
