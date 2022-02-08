@extends('layouts.app_s')

@section('title', '400 Bad Request')

@section('message', 'There is an error in the request.')
{{-- リクエストにエラーがあります。 --}}

@section('detail', 'This response indicates that the server can not understand the request because the syntax is invalid.')