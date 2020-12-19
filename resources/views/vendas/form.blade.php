@extends('adminlte::page')

@section('title', 'PDV')

@section('content_header')
    <h1>PDV</h1>
@stop

@section('content')
<div class="card card-primary">
    {!! Form::open(['route' => 'vendas.store', 'id' => 'formVenda']) !!}
      <div class="card-body">
        <div class="form-group">
            {!! Form::label('cliente_id', 'Cliente') !!}
            {!! Form::select('cliente_id', [], null, ['class' => 'form-control']) !!}
            @error('cliente_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('observacao', 'Observação') !!}
            {!! Form::textarea('observacao', null, ['class' => 'form-control', 'rows' => 2]) !!}
            @error('observacao')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('forma_pagamento', 'Forma de Pagamento') !!}
            {!! Form::select('forma_pagamento', $formasPagamento, null, ['class' => 'form-control', 'onchange' => 'atualizaPrecos()']) !!}
            @error('forma_pagamento')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-4">
                <h3>Total: <span id="txt-total">0.00</span></h3>
            </div>
            <div class="col-md-4">
                <h3>Com Desconto: <span id="txt-desconto">0.00</span></h3>
            </div>
            <div class="col-md-4">
                <h3>Com Acréscimo: <span id="txt-acrescimo">0.00</span></h3>
            </div>
        </div>

        {!! Form::submit('Finalizar Venda', ['class' => 'btn btn-primary']) !!}

        <div class="row mt-2">
            <div class="col-md-5">
                <div class="form-group">
                    {!! Form::label('produtos', 'Produtos') !!}
                    {!! Form::select('produtos', [], null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('qtd', 'Quantidade') !!}
                    {!! Form::number('qtd', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
                <label>Ação</label>
                <button type="button" class="btn btn-success btn-block" onclick="adicionarItem()">Adicionar Produto</button>
            </div>
        </div>

        <table class="table table-sm">
            <thead class="thead-dark">
              <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="tabelaItensVenda">
            </tbody>
          </table>

    {!! Form::close() !!}

      </div>
  </div>
@stop

@section('css')
@stop

@section('js')
  <script>
      $("#cliente_id").select2({
          ajax: {
              url: '{{ route('clientes.select') }}',
              dataType: 'json',
              data: function (params) {
                  return {
                      pesquisa: params.term
                  }
              },
              processResults: function (data) {
                  return {
                      results: data
                  }
              }
          }
      })
      $("#produtos").select2({
          ajax: {
              url: '{{ route('produtos.select') }}',
              dataType: 'json',
              data: function (params) {
                  return {
                      pesquisa: params.term
                  }
              },
              processResults: function (data) {
                  return {
                      results: data
                  }
              }
          }
      })
        $('#formVenda').submit(function (e) {
            e.preventDefault()
            if (totalGeral == 0) {
                Swal.fire('Ops!', 'A venda precisa ter pelo menos um produto', 'error')
                return false
            }
            axios.post('{{ route('vendas.store') }}', new FormData(e.target))
                .then((res) => {
                    window.location.href = '{{ route('vendas.index') }}'
                })
                .catch((err) => {
                    Swal.fire('Ops!', 'Ocorreu um erro ao salvar a venda', 'error')
                })
      })
      var itensVenda = []
      function adicionarItem () {
          let produto = $('#produtos').val()
          let quantidade = $('#qtd').val()
          if (produto && quantidade) {
            let urlBase = '{{ route('produtos.index') }}'
            axios.get(`${urlBase}/${produto}`)
                .then(({ data }) => {
                    itensVenda.push({
                        id: data.id,
                        descricao: data.descricao,
                        preco: data.preco,
                        quantidade: quantidade
                    })
                    atualizarTabela()
                })
                .catch(() => {
                    Swal.fire('Ops!', 'Erro ao selecionar o produto', 'error')
                })
          } else {
              Swal.fire('Ops!', 'Selecione o produto e informe a quantidade', 'error')
          }
      }
      var totalGeral = 0
      function atualizarTabela () {
        totalGeral = 0
        $('#tabelaItensVenda').empty()
        itensVenda.forEach((produto, index) => {
            let total = produto.preco * produto.quantidade
            totalGeral += total
            $('#tabelaItensVenda').append(`
                <tr><th>
                    <input type="text" class="form-control" value="${produto.descricao}" disabled>
                    <input type="hidden" name="produto_id[]" value="${produto.id}" readonly>
                </th>
                <td>
                    <input type="text" class="form-control" name="quantidade[]" value="${produto.quantidade}" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" value="${produto.preco}" disabled>
                </td>
                <td>
                    <input type="text" class="form-control" value="${total.toFixed(2)}" disabled>
                </td></tr>
            `)
        })
        atualizaPrecos()
      }
      function atualizaPrecos () {
        $('#txt-total').html(totalGeral.toFixed(2))
        let totalComDesconto = 0
        let totalComAcrescimo = 0
        if ($('#forma_pagamento').val() == 0) {
            totalComDesconto = totalGeral - (5 / 100 * totalGeral)
        } else {
            totalComAcrescimo = (10 / 100 * totalGeral) + totalGeral
        }
        $('#txt-desconto').html(totalComDesconto.toFixed(2))
        $('#txt-acrescimo').html(totalComAcrescimo.toFixed(2))
      }
  </script>
@stop
