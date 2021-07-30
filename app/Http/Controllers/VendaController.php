<?php

namespace App\Http\Controllers;

use App\DataTables\VendaDataTable;
use App\Models\Venda;
use Illuminate\Http\Request;
use App\Services\VendaService;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VendaDataTable $vendaDataTable)
    {
        return $vendaDataTable->render('vendas.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendas.form', [
            'formasPagamento' => Venda::FORMAS_PAGAMENTO
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venda = VendaService::store($request);

        if ($venda) {
            $request->session()->flash('sucesso', 'Venda finalizada com sucesso');

            return response('', 201);
        }

        return response('Erro ao salvar a venda', 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function show(Venda $venda)
    {
        return response($venda, 200);
    }

    public function edit(Venda $venda)
    {
        return view('vendas.form', compact('venda'), [
            'formasPagamento' => Venda::FORMAS_PAGAMENTO
        ]);
        
    }

    public function update(Request $request, Venda $venda)
    {
        {
            $venda = VendaService::update($request->all(), $venda);
            

            if($venda){
                return redirect()->route('vendas.index')
                    ->withSucesso('Atualizado com Sucesso');
            }
                return redirect()->route('vendas.edit', $venda)
                    ->withErro('Ocorreu um erro ao atualizar');
        }
    }


    public function destroy(Venda $venda)
    {
        $exclusao = VendaService::destroy($venda);
        return response($exclusao, $exclusao ? 200 : 400);
    }

    
}
