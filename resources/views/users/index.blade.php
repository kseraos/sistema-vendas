@extends('adminlte::page')

@section('title', 'Usuários Cadastrados')

@section('content_header')
    <h1>Usuários Cadastrados</h1>
@stop

@section('content')
    <a href="{{ route('users.create') }}"> Novo Usuário </a>
@stop

@section('css')
@stop

@section('js')
@stop