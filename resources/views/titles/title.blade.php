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
    $bgcolor = $user->bg;
    $fcolor = $user->font;
?>
@extends('layouts.app')
@section('content')

<img class="pc" src="{{ $pc_file }}" style="width:100%;">
<img class="sp" src="{{ $sp_file }}" style="width:100%;">
<div class="d-flex justify-content-center align-items-center mytitle u_color mb-4">
    <h4 class="pt-2">講座名の登録</h4>
</div>
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
     <!-- Button trigger modal -->
     <button type="button" class="btn btn-c mytitle u_color p-2 mb-2" data-toggle="modal" data-target="#Modal">新規作成</button>
    </div>
    
    @foreach($titles as $title)
    <ul class="list-group list-group-horizontal" style="width:100%;">
        <li class="list-group-item" style="padding:2px 10px;" >
        <button type="button" class="btn btn-c" data-toggle="modal" data-target="#Modal" onclick="getId(this);" value="{{$title}}">
            <i class="fas fa-edit"></i>
        </button>
        </li>
        <li class="list-group-item" style="width:90%;">{{$title->name}}</li>
    </ul>
    @endforeach
</div>
<br><br><br><br>
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">講座名登録</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="modalForm" action="{{ route('title_post') }}" method="post" onsubmit="return false">                             
                        {{ csrf_field() }}
                        <div class="form-group"><input type="hidden" name="id" class="form-control"></div>
                        <div class="form-group"><input type="hidden" name="user_id" class="form-control" required value="{{ Auth::user()->id }}"></div>
                        <div class="form-group"><input type="text" name="name" class="form-control u-input" required></div>
                        <div class="modal-footer">
                            <button type="submit" id="btn" class="btn btn-c" onClick="go_submit()">登録</button>
                            <button type="button" class="btn btn-b" data-dismiss="modal">閉じる</button>                            
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    
</div>
<script>
    function getId(key){
        let element = document.modalForm;
        let data= JSON.parse(key.value);
        element.id.value=data.id;
        element.name.value=data.name;
        document.getElementById("btn").textContent="編集";
      
    }
    function go_submit(){
            let element = document.modalForm
            document.modalForm.submit();
        }
    </script>
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
@endsection