<?php
namespace App\Services;

use App\Models\Fabricante;
use Illuminate\Support\Facades\Log;
use Throwable;

class FabricanteService 
{
    public static function store($request){
        try{
            return Fabricante::create($request);
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
    public static function destroy($fabricante)
    {
        try{
            return $fabricante->delete();
        } catch (Throwable $th){
            Log::error($th->getMessage());
            return null;
            
        }  
    }
}