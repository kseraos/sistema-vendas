<?php

namespace App\Http\Controllers;

use App\DataTables\clienteDataTable;
use App\Model\Cliente;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(clienteDataTable $clienteDataTable)
    {
        return $clienteDataTable->render('clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = ClienteService::store($request->all());
        
        if($cliente) {
            return redirect()->route('clientes.index')
                ->withSucesso('Salvo com Sucesso');
        }
        
            return redirect()->route('clientes.create')
                ->withErro('Ocorreu um erro ao salvar');
    }

  
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

   
    public function edit(Cliente $cliente)
    {
        return view('clientes.form', compact('cliente'));
    }

    
    public function update(Request $request, Cliente $cliente)
    {
        $cliente = ClienteService::update($request->all(), $cliente);

        if($cliente){
            return redirect()->route('clientes.index')
                ->withSucesso('Atualizado com Sucesso');
        }
            return redirect()->route('clientes.edit', $cliente)
                ->withErro('Ocorreu um erro ao atualizar');
    }

    
    public function destroy(Cliente $cliente)
    {
        $exclusao = ClienteService::destroy($cliente);

        return response($exclusao, $exclusao ? 200 : 400);
    }
    public function ClienteSelect(Request $request)
    {
        return ClienteService::clienteSelect($request->all());
    }
}
