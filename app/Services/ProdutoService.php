<?php

namespace App\Services;

use App\Models\Produto;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProdutoService {
    public static function store($request){
        try{
            return Produto::create($request);
        } catch (Throwable $th){
            Log::error($th->getMessage());
            return null;
            
        }
    }
    public static function update($request, $user)
    {
        try{
            return $user->update($request);
        } catch (Throwable $th){
            Log::error($th->getMessage());
            return null;
            
        }  
    }
    public static function destroy($produto)
    {
        try{
            return $produto->delete();
        } catch (Throwable $th){
            Log::error($th->getMessage());
            return null;
            
        }  
    }
    public static function produtoSelect($request)
    {
        if(isset ($request['pesquisa'])){
            return Produto::select('id', 'descricao as text')
                ->where('descricao', 'like', "%" . $request['pesquisa'] . "%")
                ->limit(10)
                ->get();

        }
        return Produto::select('id', 'descricao as text')
                ->limit(10)
                ->get();

    }
}