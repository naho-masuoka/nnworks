<?php
    $menu=['結婚指輪','婚約指輪','クレジットカード','分割払い','セットリング','オリジナルブランド','メッセージ刻印','石の持ち込み可','サイズ直し対応','ネット販売有','セミオーダー','フルオーダー','手作り',];
?>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-items-center header">
        <button type="button" class="btn" data-toggle="modal" data-target="#Modal">New</button>
    </div>
    <br>
        
        @foreach($messages as $m)
        <div>
            <ul style="width:100%;">
            <li style="width:100%;"><button type="button" class="btn" data-toggle="modal" data-target="#Modal" onclick="getId(this);" value="{{ $m }}">
            {{ mb_strimwidth($m->message, 0, 50, "...", "UTF-8") }}</li>  
            </ul>
        @endforeach

    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Mailの新規作成</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="modalForm" action="{{ route('message_create_edit') }}" method="post">                             
                        {{ csrf_field() }}
                        <div class="form-group"><input type="hidden" name="id" class="form-control"></div>
                        <div class="form-group"><input type="hidden" name="user_id" class="form-control" value={{Auth::user()->id}}></div>
                        <div class="form-group">
                            <textarea name ="message" class="form-control" rows="10"></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" id="update" class="btn btn-primary" name="btn" value="作成">  
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                                      
                        </div>
                    </form> 
            </div>
        </div>
    </div>

    <script>
        function getId(key){
            let element = document.modalForm
            let data= JSON.parse(key.value);
            element.id.value=data.id;
            element.message.value=data.message;
            element.btn.value='更新';
        }
    </script>
</div>
@endsection