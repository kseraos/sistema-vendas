<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\StoreUserPost;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $userDataTable)
    {
        
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        //User::create($request->all());
        //return redirect()->route('users.index')
        //->withSucesso('Salvo com Sucesso');

        $user =UserService::store($request->all());

        if($user){
            return redirect()->route('users.index')
                ->withSucesso('Salvo com Sucesso');
        }
            return redirect()->route('users.index')
                ->withErro('Ocorreu um erro ao salvar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user)
    {
        return view('users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user = UserService::update($request->all(), $user);

        if($user){
            return redirect()->route('users.index')
                ->withSucesso('Atualizado com Sucesso');
        }
            return redirect()->route('users.edit', $user)
                ->withErro('Ocorreu um erro ao atualizar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = UserService::destroy($user);

        if($user){
            return redirect()->route('users.index')
                ->withSucesso('Excluído com sucesso');
        }
            return redirect()->route('users.show', $user)
                ->withErro('Ocorreu um erro ao excluir');
    }
}
