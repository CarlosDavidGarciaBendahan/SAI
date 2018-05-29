<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    public function __construct(){
        $this->middleware('guest',['only'=>'showLoginForm']); //solo podremos acceder al login si somos usuarios NO  autentificados
    }


    public function showLoginForm(){
        return view('admin.login.login');
    }

    public function login(){
        //si pasa la validación devuelve un array con los datos validados
        $credentials = $this->validate(request(),[ 
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
        //return $credentials;
        //devuelve un boolean true o false verifica con datos de la BD
        if(Auth::attempt($credentials) ){
            //return 'Iniciado correctamente';
            //return Auth::user()->activa;
            if (Auth::user()->activa !== 0) {
                
                return redirect()->route('admin.home');
            } else {
                //dd('El usuario que intenta ingresar no esta activo.');
                flash("El usuario que intenta ingresar no esta activo.")->error();
                return view('admin.login.login')
                ->withErrors([$this->username() => 'El usuario que intenta ingresar no esta activo.'])
                ->withInput(request([$this->username()]));
            }
            
        }
            //return back()->withErrors([$this->username() => 'Estas credenciales no coinciden con nuestros registros']);
            flash("El usuario que intenta ingresar no esta activo.")->error();
            return back()
            ->withErrors([$this->username() => trans('auth.failed')])
            ->withInput(request([$this->username()]));
    }

    public function logout(){

        Auth::logout();

        return redirect('/');
    }

    public function username(){
        return 'name';
    }




    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //por defecto utiliza el email para autentificar, para personalizar se utiliza el metodo username
    public function username()
    {
        return 'name';
    }

    protected function redirectTo()
    {
        return redirect()->route('welcome');
    }*/
}
