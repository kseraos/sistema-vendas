<?php

namespace App\Http\Controllers;

use App\DataTables\ProdutoDataTable;
use App\Models\Produto;
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
        dd($request->all());
    }

    
    public function show(Produto $produto)
    {
        //
    }

    
    public function edit(Produto $produto)
    {
        //
    }

   
    public function update(Request $request, Produto $produto)
    {
        //
    }

    public function destroy(Produto $produto)
    {
        //
    }
}
