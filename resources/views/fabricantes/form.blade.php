@extends('adminlte::page')

@section('title', 'Fornecedor')

@section('content_header')
    <h1>Fornecedor</h1>
@stop

@section('content')
<div class="card card-primary">
  @if (isset($fabricante))
    {!! Form::model($fabricante, ['route' => ['fabricantes.update', $fabricante], 'method' => 'put']) !!}
  @else 
  {!!Form::open(['route' => 'fabricantes.store'])!!}
  @endif
      
 
      <div class="card-body">
        <div class="form-group">
            {!! Form::label('nome', 'Nome do Fornecedor')!!}
            {!! Form::text('nome', null, ['class' => 'form-control']) !!}
            @error('nome')
        <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        <div class="form-group">
            {!! Form::label('site', 'Site')!!}
            {!! Form::text('site', null, ['class' => 'form-control']) !!}
            @error('site')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('data_do_pedido', 'Data do Pedido')!!}
            {!! Form::date('data_do_pedido', null, ['class' => 'form-control']) !!}
            @error('data_do_pedido')
            <span class="text-danger">{{ $message }}</span>
            @enderror
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