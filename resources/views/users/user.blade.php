<?php
if (file_exists(asset('files/'.$user->pc))) {
        $pc_file=asset('files/'.$user->pc);
    }else{
        $pc_file=asset('files/default/pc-dummy.png');
    }
    if (file_exists(asset('files/'.$user->sp))) {
        $sp_file=asset('files/'.$user->sp);
    }else{
        $sp_file=asset('files/default/sp-dummy.png');
    }
?>
@extends('layouts.app')
@section('content')

<img class="pc" src="{{ $pc_file }}" style="width:100%;">
<img class="sp" src="{{ $sp_file }}" style="width:100%;"> 
<div class="d-flex justify-content-center align-items-center mytitle u_color mb-4">
    <h4 class="pt-1">ユーザー情報更新</h4>
</div>
<div class="container">
    @if(session('flash_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('flash_message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <form action="{{ route('user_update') }}" method="post" enctype="multipart/form-data">                             
            {{ csrf_field() }}
        <div class="form-group"><input type="hidden" name="id" class="form-control u-input" value="{{ $user->id }}"></div>
        <div class="form-group">
            <label>お名前</label>
            <input type="text" name="name" class="form-control u-input" required value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control u-input" required value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email_name" class="form-control u-input" required value="{{ $user->email_name }}">
        </div>
        <div class="form-group">
            <label>Mailを送る際に使用する署名</label>
            <input type="text" name="signature" class="form-control u-input" required placeholder="Mailの署名" value="{{ $user->signature }}">
        </div>
        <div class="form-group">
            <label>ホームページ</label>
            <input type="text" name="hp" class="form-control u-input" placeholder="ホームページ" pattern="https?://[\w!\?/\+\-_~=;\.,\*&@#\$%\(\)'\[\]]+" value="{{ $user->hp }}">
        </div>
        <div class="form-group">
            <label>ブログ</label>
            <input type="text" name="blog" class="form-control u-input" placeholder="ブログのurl" pattern="https?://[\w!\?/\+\-_~=;\.,\*&@#\$%\(\)'\[\]]+" value="{{ $user->blog }}">
        </div>
        <div>
            <div class="d-flex justify-content-between">
                <div class="form-group" style="width:47%;">
                    <label>バックカラー&nbsp;&nbsp;{{ $user->bg }}</label>
                </div>
                <div class="form-group"  style="width:47%;">
                    <label>文字の色&nbsp;&nbsp;{{ $user->font }}</label>
                </div>
            </div>   
            <div class="d-flex justify-content-between">
                <div class="form-group" style="width:47%;">
                <input type="color" name="bg" class="form-control u-input" value="{{ $user->bg }}">
                </div>
                <div class="form-group"  style="width:47%;">
                <input type="color" name="font" class="form-control u-input" value="{{ $user->font }}">
                </div>
            </div> 
        </div>
        <div class="d-flex justify-content-between">
            <div class="form-group" style="width:47%;">
                <div class="custom-file">
                <input type="file" class="custom-file-input" name="pc">
                <label class="custom-file-label" for="inputFile">PC用のヘッダー選択</label>
                </div>
            </div>
            <div class="form-group" style="width:47%;">
                <div class="custom-file">
                <input type="file" class="custom-file-input" name="sp">
                <label class="custom-file-label" for="inputFile">mobile用のヘッダー選択</label>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="form-group" style="width:47%;">
                <div class="card" style="width:100%;">
                    @if($user->pc <> null)                                 
                    <img src="{{ asset('files/'.Auth::user()->pc) }}" style="width:100%;">
               
                    @else
                        <img src="">
                    @endif
                </div>
            </div>
            <div class="form-group" style="width:47%;">
                <div class="card" style="width:100%;">
                    @if($user->sp <> null)                                 
                    <img src="{{ asset('files/'.Auth::user()->sp) }}" style="width:100%;">                    
                    @else
                        <img src="">
                    @endif
                </div>
            </div>
        </div>
        <br>
        <div class="form-group"><button type="submit" id="btn" class="form-control btn btn-c mytitle u_color mt-2">更新</button></div>            
    </form>
    <br><br><br><br>
</div>
<style>
    <style>
        .u_color{
            background-color:{{$user->bg}}; 
            color:{{$user->font}};
        }
        .u_color a{ 
            color:{{$user->font}};
        }
        .mytitle{
            padding: 0.2rem 0;/*上下の余白*/
            width:100%;
            text-align:center;
            }
        .mytitle li a{
            color:{{$user->font}};
        }
    </style>
</style>
@endsection