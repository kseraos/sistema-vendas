@extends('adminlte::page')

@section('title', 'Formulario de Produtos')

@section('content_header')
    <h1>Formulario de Produtos</h1>
@stop

@section('content')
<div class="card card-primary">
  @if (isset($produto))
    {!! Form::model($produto, ['route' => ['produtos.update', $produto], 'method' => 'put']) !!}
  @else 
  {!!Form::open(['route' => 'produtos.store'])!!}
  @endif
      
 
      <div class="card-body">
        <div class="form-group">
            {!! Form::label('descricao', 'Descrição')!!}
            {!! Form::text('descricao', null, ['class' => 'form-control']) !!}
            @error('descricao')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('estoque', 'Estoque')!!}
                    {!! Form::text('estoque', null, ['class' => 'form-control']) !!}
                    @error('estoque')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('preco', 'Preço')!!}
                    {!! Form::text('preco', null, ['class' => 'form-control']) !!}
                    @error('preco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>

        <div class="form-group">
            {!! Form::label('fabricante_id', 'Fabricante')!!}
            {!! Form::select('fabricante_id', [],  null, ['class' => 'form-control']) !!}
            @error('fabricante_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
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
    <script>

        var dados = []
        @isset($produto)
            var selecionado = {
                id:'{{$produto->fabricante->id}}',
                text:'{{$produto->fabricante->nome}}',
                selected: true
            }
            dados.push(selecionado)
        @endisset
        $("#fabricante_id").select2({
            data:dados,
            ajax: {
                url:'{{route('fabricantes.select')}}',
                dataType:'json',
                data: function (params){
                    return {
                        pesquisa: params.term
                    }
                },
                processResults: function (data){
                    return {

                        results:data
                    }
                }
            }
        }) 
       
    </script>
@stop