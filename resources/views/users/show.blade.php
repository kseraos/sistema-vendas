@extends('adminlte::page')

@section('title', 'Usuário')

@section('content_header')
    <h1>Usuário</h1>
@stop

@section('content')
   
    <div class="card">
        <div class="card-body">
        <h1> Deseja excluir este usuário?</h1>
        <h2>{{$user->name}}</h2>
         {!! Form::model($user, ['route'=>['users.destroy', $user], 'method' => 'delete']) !!}
            {!! Form::submit('Sim', ['class'=> 'btn btn-danger']) !!}
            {!! link_to_route('users.index', 'Cancelar', [], ['class'=> 'btn btn-secondary']) !!}
         {!! Form::close() !!}
        </div>

    </div>

@stop

@section('css')
@stop

@section('js')

    


@stop