<?php

namespace App\Http\Controllers;

use App\DataTables\FabricanteDataTable;
use App\Models\Fabricante;
use App\Services\FabricanteService;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    public function index(FabricanteDataTable $FabricanteDataTable)
    {
        
        return $FabricanteDataTable->render('fabricantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fabricantes.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //User::create($request->all());
        //return redirect()->route('users.index')
        //->withSucesso('Salvo com Sucesso');

        $fabricante=FabricanteService::store($request->all());

        if($fabricante){
            return redirect()->route('fabricantes.index')
                ->withSucesso('Salvo com Sucesso');
        }
            return redirect()->route('fabricantes.index')
                ->withErro('Ocorreu um erro ao salvar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fabricante $fabricante)
    {
        return view('fabricantes.show', compact('fabricante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fabricante $fabricante)
    {
        return view('fabricantes.form', compact('fabricante'));
    }

    public function update(Request $request, Fabricante $fabricante)
    {
        $fabricante = FabricanteService::update($request->all(), $fabricante);

        if($fabricante){
            return redirect()->route('fabricantes.index')
                ->withSucesso('Atualizado com Sucesso');
        }
            return redirect()->route('fabricantes.edit', $fabricante)
                ->withErro('Ocorreu um erro ao atualizar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fabricante $fabricante)
    {
        $fabricante = FabricanteService::destroy($fabricante);

        if($fabricante){
            return redirect()->route('users.index')
                ->withSucesso('Excluído com sucesso');
        }
            return redirect()->route('users.show', $fabricante)
                ->withErro('Ocorreu um erro ao excluir');
    }
  
}