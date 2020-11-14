<?php
namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserService 
{
    public static function store($request){
        try{
            return User::create($request);
        } catch (Throwable $th){
            Log::error($th->getMessage());
            return null;
            
        }
    }
}