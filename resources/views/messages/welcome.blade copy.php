<?php
    $f=$ymd[0]['day']->format('w');
    $i = 0;

?>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-items-center header">
        <h3>
            <a href="?day={{ $prev }}">{{ $prev->format('n月') }}</a>&nbsp;&nbsp;{{ $start->format('Y年n月') }}&nbsp;&nbsp;<a href="?day={{ $next }}">
                {{ $next->format('n月') }}
            </a>
        </h3>
    </div>
    <table class="table table-bordered calendar">
        <tr class="week">
            <th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th><th>日</th>
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
                <p class="day">{{ $d['day']->format('j') }}<br><span class="horiday">{{ $d['holiday'] }}</span></p>
                </span>
                    @foreach($rs as $r)
                        </br>
                        @if($r->flg == null)
                        <button type="button" class="btn badge badge-amairo" style="font-size:5px" data-toggle="modal" data-target="#exampleModal" onclick="getId(this);" value="{{ $r }}">           
                        {{date('H:i',strtotime($r->start))}}</button>
                        @endif
                    @endforeach
                    </td>
                @if($w == 0)
            </tr>
                @endif
        @endforeach
    </table>

    <div class="blog d-flex justify-content-center align-items-center">
        <div class="card" style="width: 100%;">
            <div class="card-body" style="background-color:#ff6768;color:white;padding:5px 0;">
            <a href="https://ameblo.jp/houjyo-office/" style="color:#ffffff;"><h3 class="text-center">Blog　〜 人生創造の遊び場 ～</h3></a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm">
                    @for($i=0; $i < 5; $i++) 
                    <tr>                  
                        <td>{{ date('y.m.d', strtotime($xml->channel->item[$i]->pubDate)) }}</a></td>
                        <td><a href="{{ $xml->channel->item[$i]->link }}">{{ $xml->channel->item[$i]-> title}}</a></td>       
                    </tr>
                    
                    @endfor  
                </table>
            </div>
        </div>        
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
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
                        <div class="form-group"><input type="text" name ="name" class="form-control" placeholder="お名前" required></div>
                        <div class="form-group"><input type="email" name ="email" class="form-control"  placeholder="e-mail" required></div>
                        <div class="form-group">
                            <small>↓参加人数↓</small>
                            <input type="number" name ="member" class="form-control" value="1" required>
                        </div>
                        <div class="form-group"><input type="hidden" name ="flg" class="form-control" value=1 required></div>
                        <div class="form-group">
                            <small>↓メッセージ</small>
                            <textarea name ="memo" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn" class="btn btn-primary" onClick="go_submit()">申込</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>                            
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
        let element = document.modalForm
        let data= JSON.parse(key.value);
        let day = data.day.substr(5, 2)+ "月" + data.day.substr(8, 2) +"日";
        let title_time = day + " " + data.start.substr(0, 5) + '～' + data.end.substr(0, 5);
        element.id.value=data.id;
        document.getElementById("title_time").textContent=title_time;
        document.getElementById("ModalLabel").textContent='講座名: '+ data.title.name;
      
    }
    function go_submit(){
            let element = document.modalForm
            document.modalForm.submit();
        }
    </script>
@endsection
