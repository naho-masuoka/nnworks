@extends('layouts.app_s')

@section('title', '503 Service Unavailable')
{{-- サービス利用不可 --}}

@section('message', 'You can not access this page due to circumstances.')
{{-- このページへは事情によりアクセスできません。 --}}

@section('detail', 'Service is temporarily unusable due to overload or maintenance.')
{{-- サービスが一時的に過負荷やメンテナンスで使用不可能な状態です。 --}}