<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\DB;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return redirect('/')->with('flash','Por favor, inicie sesión.');
        }
        if ($exception instanceof \Illuminate\Database\QueryException) {
            if ($exception->getCode() === '23505') {
                flash('ERROR!!! Los datos que intenta ingresar ya existen.')->error();

            }
            if ($exception->getCode() === '23503') { 
                flash('ERROR!!! Intenta eliminar un registro que tiene información asociada a él.')->error();
            }
            flash('ERROR con la base de datos. Código QueryException error: '.$exception->getCode())->error();
            




            
            //flash('ERROR en la base de datos. ')->error();
            //flash($exception->getCode())->error();
            //DB::rollback();
            return redirect()->back();
        }
        /*if ($exception instanceof \Illuminate\Remote\Connection) {
            flash('ERROR con la conexion intente más tarde.')->error();
            return redirect()->back();
        }
        if ($exception instanceof Illuminate\Mail\swiTransport) {
            flash('ERROR con la conexion intente más tarde.')->error();
            return redirect()->back();
        }*/
        
        return parent::render($request, $exception);
    }
}
