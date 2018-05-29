<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;
use App\Personal;
use App\Rol;
use App\Http\Requests\UserRequest;
use App\Mail\EnvioDeClaveTemporal;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('name')->paginate(10);

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
        $personal = Personal::where('id','>',0)->whereNotIn('id',$ids)->orderby('per_apellido','per_nombre')->get();//Busco el personal que notenga usuario.

        if (count($personal) === 0) {
            
            flash("Todos los empleados tienen usuario creado.")->error();
            return redirect()->route('users.index');
        } else {
            $roles = Rol::where('rol_tipo','=','U')->orderby('rol_rol')->pluck('rol_rol','id');

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
        //dd($this->CrearClave());
        //dd(bcrypt($request->password));
        $claveTemporal = $this->CrearClave();//Genera una clave aleatoria de 8 caracteres

        $user = new User($request->all());
        $user->password = bcrypt($claveTemporal); 
        $user->save();

        //$user->roles()->sync($request->roles);
        
        $this->EnviarClaveTemporal($user,$claveTemporal);

        flash("Registro del usuario '' ".$request->name." '' exitoso ".$claveTemporal)->success();
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
        //$personal = Personal::orderby('per_apellido','per_nombre')->get();
        $roles = Rol::where('rol_tipo','=','U')->orderby('rol_rol')->pluck('rol_rol','id');

        return view('admin.oficina.users.edit')->with(compact('user',/*'personal',*/'roles'));
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
        if (auth()->user()->id === $user->id) {//mismo usuario
            
            $user->password = bcrypt($request->password); 

        } else {//diferente usuario
            if ($user->id !== 0) {
                $user->activa = $request->activa;
                $user->fk_rol = $request->fk_rol;
            } else {
                flash("El usuario '' ". $user->name." '' no puede cambiar de estado ni de rol.")->error();
                return redirect()->route('users.index');
            }
            
        }
        
        
        $user->save();


        //$user->roles()->detach();
        //$user->roles()->sync($request->roles);

        flash("Modificación del usuario '' ". $user->name." '' exitosa")->success();
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

        //$user->Roles()->detach($user->Roles);
        if ($user->id !== 0) {
            if (Auth::user()->id === $user->id) {
                flash("Imposible eliminar al usuario logeado.")->success();
            } else {
                $user->delete();

                flash("Eliminación del usuario '' ". $user->name." '' exitosa")->success();
                //return redirect()->route('users.index');
            }
            
        } else {

            flash("El usuario admin no puede eliminarse del sistema.")->error();
            //return redirect()->route('users.index');
        }
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



    public function CrearClave() { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8); 
    }

    public function EnviarClaveTemporal($user, $clave){

        foreach ($user->personal->contacto_correos as $correo) {
                \Mail::to($correo->con_cor_correo)->send(new EnvioDeClaveTemporal("Se le notifica que para su usuario ".$user->name." se le ha asignado la clave: ".$clave." que deberá modificar una vez ingrese al sistema. Borrar este mensaje por seguridad.","Envio de clave para acceder al sistema SAI"));
        }
        flash("Se ha realizado el envio de la clave a los correos del personal ".$user->personal->per_nombre." ".$user->personal->per_nombre2." ".$user->personal->per_apellido." ".$user->personal->per_apellido2)->success();
    }

    public function reset(){
        return view('admin.login.reset');
    }


    public function resetClave(Request $request){

        $user = User::where('name','=',$request->name)->get();

        //dd($user);
        //dd($request->all());
        foreach ($user as  $u) {
            //dd($u);
            if ($u->activa !== 0) {//si esta activa la cuenta
                $u->solicitar_clave = 1;//cambio el esto de solicitar_clave a 1
                $u->activa = 0; //desactivo la cuenta para que no pueda ser utilizada hasta no dar nueva clave
                $u->save(); // guardo los cambios
                flash("Se ha enviado la solicitud para reestablecer una nueva clave al correo del personal: ".$u->personal->per_identificador."-".$u->personal->per_cedula)->success();
                return redirect()->route('inicio');

            } else {
                flash("El usuario ".$u->name." se encuentra inactivo. No puede solicitar nueva clave.")->error();
                return redirect()->back();
            }
            
        }
        //busco el usuario por su nombre
        //NO PUEDE estar desactivado
        //SI ESTA ACTIVO
        //CAMBIO EL ATRIBUTO DE soliciar_clave a cualquire numero diferente de 0 
        //DESACTIVO LA CUENTA, PORQUE NO PUEDE SER UTILIZADA MIENTRAS TANTO NO SE CAMBIE LA CLAVE

    }

    public function EnviarClave($id){
        $user = user::find($id);

        if ($user->activa === 0 && $user->solicitar_clave !== 0) {
            $clave = $this->CrearClave();

            $user->password = bcrypt($clave);
            $user->activa = 1;

            $user->save();

            $this->EnviarClaveTemporal($user,$clave);


            //flash("Se ha enviado la nueva clave del usuario ".$user->name." al correo del empleado: ". $user->personal->per_nombre." ".$user->personal->per_nombre2." ".$user->personal->per_apellido." ".$user->personal->per_apellido2)->success();
        } else {
            flash("El usuario ".$user->name." esta desactivado. NO es posible reenviar una nueva clave")->error();
        }
        
        
        return redirect()->route('users.index');
    }



}
