@extends('adminlte::page')

@section('title', 'Formulário de Usuário')

@section('content_header')
    <h1>Formulário de Usuário</h1>
@stop

@section('content')
<div class="card card-primary">
  @if (isset($user))
    {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put']) !!}
  @else 
  {!!Form::open(['route' => 'users.store'])!!}
  @endif
      
 
      <div class="card-body">
        <div class="form-group">
            {!! Form::label('name', 'Nome')!!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @error('name')
        <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        <div class="form-group">
            {!! Form::label('email', 'Email')!!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Senha')!!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('type', 'Tipo de Usuário')!!}
            {!! Form::select('type',['0' => 'Vendedor', '1' => 'Administrador'], null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="card-footer">
        {!!Form::submit('Salvar', ['class' =>'btn btn-primary'])!!}
      </div>
      {!! Form::close() !!}
  </div>
@stop


@section('css')
@stop

@section('js')
@stop