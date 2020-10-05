<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index',[
            'users' => User::paginate(10)
        ]);
    }

    public function create(){
        return view('user.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed']            
        ]);

        $user = new User();
        $user->name = $request->name;
        if($user->email  !== $request->email){
            $user->email = $request->email;
        }

        $user->password =  Hash::make($request->password);

        if($user->save()){
            return redirect()->route('user.index')->with(['success' => "Usuário {$user->name} cadastrado com sucesso!"]);
        }
        return redirect()->route('user.index')->with(['fail' => "Não foi possível Cadastrar Usuário Usuário {$user->name}!"]);
    }
    


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {        
        return view('user.show',[
            'user' =>  $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->id === Auth::user()->id){
            return view('user.edit',[
                'user' =>  $user
            ]);
        }

        return redirect()->route('user.index')->with(['fail' => "Sem permissão para editar Usuário  {$user->name}!!"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id]
        ]);

        $user->name = $request->name;
        if($user->email  !== $request->email){
            $user->email = $request->email;
        }
        if($user->save()){
            return redirect()->route('user.index')->with(['success' => "Usuário {$user->name} salvo com sucesso!"]);
        }
        return redirect()->route('user.index')->with(['fail' => "Não foi possível salvar Usuário {$user->name}!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id === Auth::user()->id){
           $user->delete();
           Auth::logout();           
        }
        return redirect()->route('user.index')->with(['fail' => 'Sem permissão para Excluir esse usuário!!']);
    }
}
