<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;
use App\Personal;
use App\Rol;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('name')->paginate(5);

        return view('admin.oficina.users.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ids = $this->PersonalConUsuario();//consigo todos los ID de cada personal con usuario.
        $personal = Personal::whereNotIn('id',$ids)->orderby('per_apellido','per_nombre')->get();//Busco el personal que notenga usuario.

        if (count($personal) === 0) {
            
            flash("Todos los empleados tienen usuario creado.")->error();
            return redirect()->route('users.index');
        } else {
            $roles = Rol::orderby('rol_rol')->pluck('rol_rol','id');

            return view('admin.oficina.users.create')->with(compact('personal','roles'));
        }
        

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        
        //dd(bcrypt($request->password));
         
        $user = new User($request->all());
        $user->password = bcrypt($request->password); 
        $user->save();

        $user->roles()->sync($request->roles);
        
        flash("Registro del usuario '' ".$request->name." '' exitoso")->success();
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $personal = Personal::orderby('per_apellido','per_nombre')->get();
        $roles = Rol::orderby('rol_rol')->pluck('rol_rol','id');

        return view('admin.oficina.users.edit')->with(compact('user','personal','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = $request->password;
        $user->activa = $request->activa;
        $user->save();


        $user->roles()->detach();
        $user->roles()->sync($request->roles);

        flash("Modificación del usuario". $user->name." '' exitosa")->success();
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->Roles()->detach($user->Roles);

        $user->delete();

        flash("Eliminación del usuario". $user->name." '' exitosa")->success();
        return redirect()->route('users.index');
    }

    public function PersonalConUsuario(){
        $users = user::all();
        $ids = array(); 

        foreach ($users  as $user) {
            array_push($ids,$user->fk_personal);
        }
        //dd($ids);

        return $ids;
    }
}
