<?php
if ($user->pc == null) {
    $pc_file=asset('/images/pc-dummy.png');
}else{
    $pc_file=asset('/storage/files/'.$user->pc);
}

if ($user->sp == null) {
    $sp_file=asset('/images/sp-dummy.png');
        
}else{
    $sp_file=asset('/storage/files/'.$user->sp);
}
?>
@extends('layouts.app')
@section('content')

<img class="pc" src="{{ $pc_file }}" style="width:100%;">
<img class="sp" src="{{ $sp_file }}" style="width:100%;height:150px;">
<div class="d-flex justify-content-around align-items-center mytitle u_color mb-4">            
    <div><a href="?day={{ $prev }}" style="color:white;">{{ $prev->format('n月') }}<i class="fas fa-arrow-left ml-2"></i></a></div>
    <div><h4 class="pt-2">{{$start->format('Y年n月')}}</h4></div>
    <div><a href="?day={{ $next }}" style="color:white;"><i class="fas fa-arrow-right mr-2"></i>{{ $next->format('n月') }}</a></div>        
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
    
    <div class="overflow-auto">
    @foreach($ymd as $d)
    <?php
       
        $w=date('w',strtotime($d['day']));
        $cn=null;
        if($d['holiday'] <> null){
            $cn='color:red;';
        }else{
            if($w == 6){
                $cn='color:blue;';
            }elseif($w == 0){
                $cn='color:red;';
            }
        }
    ?>
        <ul class="list-group list-group-horizontal" style="width:100%;">
            <li class="list-group-item align-middle" style="width:10%;{{$cn}};">{{$d['day']->format('j')}}</li>
            <li class="list-group-item text-center">
            <!-- Button trigger modal -->
            <button id="{{$d['day']->format('j')}}" type="button" class="btn btn-c u_color" data-toggle="modal" data-target="#Modal" onclick="getId(this);" value="{{$d['day']->format('Y-m-d')}}">
            <i class="fas fa-edit"></i>
            </button>
            </a></li>
            <li class="list-group-item" style="width:80%;">
            @foreach($timetable as $key =>$tt)
                @if($tt->day == $d['day']->format('Y-m-d'))
                        <?php
                            if($tt->flg == null){
                                $c='btn-blue';
                                $func='contact(this);';
                            }elseif($tt->flg == 2){
                                $c='btn-gray';
                                $func='test(this);';
                            }else{
                                $func='test(this);';
                                $c='btn-yellow';
                        }
                        ?>
                        <button type="button" class="btn {{ $c }}" data-toggle="modal" data-target="#Modal" onClick="{{ $func }}" value="{{$tt}}">
                        {{date('H:i',strtotime($tt->start))}}～{{date('H:i',strtotime($tt->end))}}<span class="badge badge-light ml-1">{{$tt->mail_flg}}</span>
                    </button>
                @endif
            @endforeach
            </li>
        </ul>
    @endforeach
    </div>
    <br><br><br>
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
                    <form name="modalForm" action="{{ route('time_teble_store') }}" method="post" onsubmit="return false">                             
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id">
                            <input type="hidden" name ="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="mailmap" class="form-control">
                            <input type="hidden" name="btn" class="form-control">
                            <input type="hidden" name="map" class="form-control">
                        </div>
                        
                        <div class="d-flex">
                            <div class="form-group col-3"><label class="lb">講座名</label></div>
                            <div class="form-group col-9">
                                <select id="myselect" name="title_id" class="form-control u-input" style="font-size: 1.4rem;" required>
                                    @foreach($title_name as $tn)
                                    <option value="{{ $tn->id }}">{{$tn->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-3"><label class="lb">開催日</label></div>
                            <div class="form-group col-9"><input type="date" name="day" class="form-control u-input" style="font-size: 1.4rem;" required></div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-3"><label class="lb">開始</label></div>
                            <div class="form-group col-9"><input type="time" name ="start" class="form-control u-input" style="font-size: 1.4rem;" required><p class="err-msg-start" style="display=none;"></p></div>
                        </div>
                        <div class="d-flex">
                        <div class="form-group col-3"><label class="lb">終了</label></div>
                            <div class="form-group col-9"><input type="time" name ="end" class="form-control u-input" style="font-size: 1.4rem;" required><p class="err-msg-end" style="display=none;"></p></div>
                        </div>
                        <div id="name-area" class="d-flex">
                            <div class="form-group col-3"><label class="lb">お名前</label></div>
                            <div class="form-group col-9"><input type="text" name ="name" class="form-control u-input" style="font-size: 1.4rem;"></div>
                        </div>
                        <div id="email-area" class="d-flex">
                            <div class="form-group col-3"><label class="lb">E-mail</label></div>
                            <div class="form-group col-9"><input type="email" name ="email" class="form-control u-input" style="font-size: 1.4rem;"></div>
                        </div>
                        <div id="member-area" class="d-flex justify-content-between">
                            <div class="form-group col-3"><label class="lb">人数</label></div>
                            <div class="form-group col-9"><input type="number" name ="member" class="form-control u-input" style="font-size: 1.4rem;"></div>
                        </div>
                        <div id="address-area" class="d-flex justify-content-between">
                            <div class="form-group col-3"><label class="lb">住所</label></div>                        
                            <div class="form-group col-9"><input type="text" name="place" class="form-control u-input" style="font-size: 1.4rem;"></div>
                        </div>
                        <div id="shop_name-area" class="d-flex justify-content-between">
                            <div class="form-group col-3"><label class="lb">場所</label></div>                        
                            <div class="form-group col-9"><input type="text" name="shop_name" class="form-control u-input" style="font-size: 1.4rem;"></div>
                        </div>
                        <div id="memo-area">
                            <div class="form-group col-6"><label class="lb">message</label></div>
                            <div class="form-group col-12"><textarea name ="memo" class="form-control u-input" style="font-size: 1.4rem;"></textarea></div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" id="r_cancel" class="btn btn-c u_color" value="予約可能に戻す" onClick="go_submit('キャンセル');">
                            <input type="submit" id="r_email" class="btn btn-c u_color" value="Email作成" onClick="go_submit('Email作成');">
                            <input type="submit" id="update" class="btn btn-y" value="更新" onClick="go_submit('更新');">  
                            <button type="button" class="btn btn-b" data-dismiss="modal">閉じる</button>                          
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <!-- Modal_2 -->
</div>
<script>
    function getId(key){
        let t = <?php echo $title_name->count(); ?>;
        let element = document.modalForm;
        if(t > 0){
            element.id.value=null;
            element.day.value=key.value;
            element.start.value='08:00';
            element.end.value='09:00';
            document.getElementById("r_cancel").style.display="none";
            document.getElementById("r_email").style.display="none";
            document.getElementById("update").value="作成";
        }else{
            document.getElementById("ModalLabel").textContent="講座名を作成してください";
            element.style.display="none";
        }
        document.getElementById("myselect").options[0].selected = true;
        for (let i = 1; i < 7; i++) {
            switch (i){
                case 1:
                    area="name-area";
                    break;
                case 2:
                    area="email-area";
                    break;
                case 3:
                    area="member-area";
                    break;
                case 4:
                    area="address-area";
                    break;
                case 5:
                    area="shop_name-area";
                    break;
                case 6:
                    area="memo-area";
                    break;
                default:
                    area="ないよ";
            }
            let parent = document.getElementById(area);
            let frame_children = parent.children;
            for (let j = 0; j < frame_children.length; j++) {
                frame_children[j].style.display="none";
            }
        }
    }
    
    function contact(key){
        let element = document.modalForm;
        let data= JSON.parse(key.value);
        element.id.value=data.id;
        element.day.value=data.day;
        element.start.value=data.start;
        element.end.value=data.end;

        for (let i = 1; i < 7; i++) {
            switch (i){
                case 1:
                    area="name-area";
                    break;
                case 2:
                    area="email-area";
                    break;
                case 3:
                    area="member-area";
                    break;
                case 4:
                    area="address-area";
                    break;
                case 5:
                    area="shop_name-area";
                    break;
                case 6:
                    area="memo-area";
                    break;
                default:
                    area="ないよ";
            }
            let parent = document.getElementById(area);
            let frame_children = parent.children;
            for (let j = 0; j < frame_children.length; j++) {
                frame_children[j].style.display="none";
            }
        }
        document.getElementById("r_email").style.display="none";
        document.getElementById("update").value="更新";
        document.getElementById("r_cancel").style.display="none";
        document.getElementById("myselect").options[data.title_id-1].selected = true; 
    }

    function test(key){
        let element = document.modalForm;
        let data= JSON.parse(key.value);
        element.id.value=data.id;
        element.day.value=data.day;
        element.start.value=data.start;
        element.end.value=data.end;
        element.place.value=data.place;
        element.shop_name.value=data.shop_name;
        element.map.value=data.map;
        element.mailmap.value=data.mailmap;
        element.name.value=data.name;
        element.email.value=data.email;
        element.member.value=data.member;
        element.memo.value=data.memo;
        document.getElementById("ModalLabel").textContent = data.title_name;
        document.getElementById("myselect").options[data.title_id-1].selected = true;    
        if(data.flg == 2){
            document.getElementById("r_email").style.display="none";
            document.getElementById("r_cancel").style.display="block";
        }else{
            document.getElementById("r_email").style.display="block";
            document.getElementById("r_cancel").style.display="none";
        }
        for (let i = 1; i < 7; i++) {
            switch (i){
                case 1:
                    area="name-area";
                    break;
                case 2:
                    area="email-area";
                    break;
                case 3:
                    area="member-area";
                    break;
                case 4:
                    area="address-area";
                    break;
                case 5:
                    area="shop_name-area";
                    break;
                case 6:
                    area="memo-area";
                    break;
                default:
                    area="ないよ";
            }
            let parent = document.getElementById(area);
            let frame_children = parent.children;
            for (let j = 0; j < frame_children.length; j++) {
                frame_children[j].style.display="block";
            }
        }
    }

    function go_submit(key){ 
        let element = document.modalForm;
        element.btn.value=key;
        const start = element.start.value;
        const end = element.end.value;
        const errstart = document.querySelector('.err-msg-start');
        if(start > end){
            errstart.style.display="block";
            errstart.textContent = '終了時間より前の時間で入力してください';
            return false;                
        }else{
            errstart.style.display="none";
            errstart.textContent = '';
        }
        element.submit();
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