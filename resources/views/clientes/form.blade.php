@extends('adminlte::page')

@section('title', 'Formulário de Cliente')

@section('content_header')
    <h1>Formulário de Cliente</h1>
@stop

@section('content')
<div class="card card-primary">
    @if (isset($cliente))
        {!! Form::model($cliente, ['route' => ['clientes.update', $cliente], 'method' => 'put']) !!}
    @else
        {!! Form::open(['route' => 'clientes.store']) !!}
    @endif
      <div class="card-body">
          <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                    @error('nome')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('telefone', 'Telefone') !!}
                    {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
                    @error('telefone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                  {!! Form::label('cpf', 'CPF') !!}
                  {!! Form::text('cpf', null, ['class' => 'form-control']) !!}
                  @error('cpf')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                  {!! Form::label('email', 'E-mail') !!}
                  {!! Form::email('email', null, ['class' => 'form-control']) !!}
                  @error('email')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('cep', 'CEP') !!}
                    {!! Form::text('cep', null, ['class' => 'form-control', 'onfocusout' => 'buscaCep()']) !!}
                    @error('cep')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    {!! Form::label('logradouro', 'Logradouro') !!}
                    {!! Form::text('logradouro', null, ['class' => 'form-control']) !!}
                    @error('logradouro')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('bairro', 'Bairro') !!}
                    {!! Form::text('bairro', null, ['class' => 'form-control']) !!}
                    @error('bairro')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('localidade', 'Localidade') !!}
                    {!! Form::text('localidade', null, ['class' => 'form-control']) !!}
                    @error('localidade')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
      </div>

      <div class="card-footer">
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}
  </div>
@stop

@section('css')
@stop

@section('js')
  <script>
      function buscaCep () {
        let cep = $('#cep').val()
        axios.get(`https://viacep.com.br/ws/${cep}/json/`)
            .then(({ data }) => {
                $('#logradouro').val(data.logradouro)
                $('#bairro').val(data.bairro)
                $('#localidade').val(data.localidade)
            })
            .catch(() => {
                Swal.fire('Ops!', 'Erro ao consultar CEP', 'error')
            })
      }
  </script>
@stop