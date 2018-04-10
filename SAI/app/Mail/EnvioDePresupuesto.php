<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnvioDePresupuesto extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje;
    public $subject;
    public $path;  
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje,$id,$subject)
    {
        $this->mensaje = $mensaje;
        $this->subject = $subject;
        $this->name = 'Presupuesto#' . $id  . '.pdf';
        $this->path = public_path() . '/presupuesto/'; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correo.ejemplo1')
                    ->subject($this->subject)
                    ->attach($this->path . $this->name);

    }
}
