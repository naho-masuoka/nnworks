<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use InterventionImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

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
        $path = storage_path('public/files/');
        
        if($request->has('pc')){            
            if(file_exists($path.$user->pc) == true){
                unlink($path.'/'.$user->pc);
            }
            $file = $request->file('pc');
            $extension= $file->getClientOriginalExtension();        
            $pc=$user->id .'_pcheader.'.$extension;
            InterventionImage::make($file)
                ->fit( 1200, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    }
                )
                ->save($path.$pc);
        }
        if($request->has('sp')){
            
            if(file_exists($path.$user->sp) == true){
                unlink($path.'/'.$user->sp);
            }
            $file = $request->file('sp');
            $extension= $file->getClientOriginalExtension();                
            $sp= $user->id .'_spheader.'.$extension;
            InterventionImage::make($file)
                ->fit( 450, 150, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    }
                )
                ->save($path.$sp);
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
