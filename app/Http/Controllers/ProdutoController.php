<?php

namespace App\Http\Controllers;

use App\DataTables\ProdutoDataTable;
use App\Models\Produto;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    
    public function index(ProdutoDataTable $produtoDataTable)
    {
        return $produtoDataTable->render('produtos.index');
    }

    
    public function create()
    {
        return view('produtos.form');
    }

   
    public function store(Request $request)
    {
        $fabricante=ProdutoService::store($request->all());

        if($fabricante){
            return redirect()->route('produtos.index')
                ->withSucesso('Salvo com Sucesso');
        }
            return redirect()->route('produtos.index')
                ->withErro('Ocorreu um erro ao salvar');
    }

    
    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    
    public function edit(Produto $produto)
    {
        return view('produtos.form', compact('produto'));
    }

   
    public function update(Request $request, Produto $produto)
    {
        $fabricante = ProdutoService::update($request->all(), $produto);

        if($fabricante){
            return redirect()->route('produtos.index')
                ->withSucesso('Atualizado com Sucesso');
        }
            return redirect()->route('produtos.edit', $produto)
                ->withErro('Ocorreu um erro ao atualizar');
    }

    public function destroy(Produto $produto)
    {
        $exclusao = ProdutoService::destroy($produto);
        return response($exclusao, $exclusao ? 200 : 400);
    }
}