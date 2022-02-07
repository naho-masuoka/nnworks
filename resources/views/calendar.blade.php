<?php
    $f=$ymd[0]['day']->format('w');
    $i = 0;
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
<div class="d-flex justify-content-around align-items-center mytitle mb-4">
    <div><a href="?day={{ $prev }}" style="color:{{$user->font}};">{{ $prev->format('n月') }}<i class="fas fa-arrow-left ml-2"></i></a></div>
    <div><h4 class="pt-1">{{ $start->format('Y年n月') }}  </h4></div>
    <div><a href="?day={{ $next }}" style="color:{{$user->font}};"><i class="fas fa-arrow-right mr-2"></i>{{ $next->format('n月') }}</a></div>
</div>
<div class="container">
    
    <table class="table table-bordered calendar">
        <tr class="week">
            <td class="align-middle">月</td><td class="align-middle">火</td>
            <td class="align-middle">水</td><td class="align-middle">木</td>
            <td class="align-middle">金</td><td class="align-middle">土</td><td class="align-middle">日</td>
        </tr>
        <tr>       
            @foreach($ymd as $d)
            <?php 
                $rs=$reservation->whereIn('day',date('Y-m-d',strtotime($d['day'])));
                $w=$d['day']->format('w');
                $hd=$d['holiday'];
            ?>
                @if($w == 7)
                <tr>
                @endif
                <td>
                @if($hd <> null)
                    <span style="color:red;">
                @else
                    @if($w == 6)
                        <span style="color:blue;">
                    @elseif($w == 0)
                        <span style="color:red;">
                    @else
                    <span>
                    @endif
                @endif
                {{-- {{ $d['holiday'] }} --}}
                <p class="day">{{ $d['day']->format('j') }}</p>
                <p class="horiday">{{ $d['holiday'] }}</p>
                    @foreach($rs as $r)                     
                        @if($r->flg == null)
                        <button type="button" class="btn badge badge-amairo" data-toggle="modal" data-target="#Modal" onclick="getId(this);" value="{{ $r }}">           
                        {{date('H:i',strtotime($r->start))}}</button>
                        @endif
                    @endforeach
                    </td>
                @if($w == 0)
            </tr>
                @endif
        @endforeach
    </table>
    <br><br><br><br><br><br>
</div>

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-color">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div>
                    <p id="title_time"></p>
                </div>
                    <form name="modalForm" action="{{ route('reserve') }}" method="post" onsubmit="return false">                             
                        {{ csrf_field() }}
                        <div class="form-group"><input type="hidden" name="id" class="form-control"></div>
                        <div class="form-group"><input type="text" name ="name" class="form-control u-input" placeholder="お名前" required></div>
                        <div class="form-group"><input type="email" name ="email" class="form-control u-input"  placeholder="e-mail" required></div>
                        <div class="form-group">
                            <small>↓参加人数↓</small>
                            <input type="number" name ="member" class="form-control u-input" value="1" required>
                        </div>
                        <div class="form-group"><input type="hidden" name ="flg" class="form-control" value=1 required></div>
                        <div class="form-group">
                            <small>↓メッセージ</small>
                            <textarea name ="memo" class="form-control u-input" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn" class="btn btn-c" onClick="go_submit()">申込</button>
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
        let day = data.day.substr(5, 2)+ "月" + data.day.substr(8, 2) +"日";
        let title_time = day + " " + data.start.substr(0, 5) + '～' + data.end.substr(0, 5);
        element.id.value=data.id;
        document.getElementById("title_time").textContent=title_time;
        document.getElementById("ModalLabel").textContent='講座名: '+ data.title.name;
      
    }
    function go_submit(){
        let element = document.modalForm;
        if (element.name.value == "" || element.email.value == ""){
            return false;
        }else{
            document.modalForm.submit();
        }
    }
    </script>
    <style>
    .mytitle{
        padding: 0.2rem 0;/*上下の余白*/
        width:100%;
        text-align:center;
        background-color:{{$user->bg}}; 
        color:{{$user->font}};
        }
    .mytitle li a{
        color:{{$user->font}};
    }
    .calendar .week{
        background-color:{{$user->bg}}; 
        color:{{$user->font}};
        text-align:center;
        height:5%;
    }
</style>
@endsection
