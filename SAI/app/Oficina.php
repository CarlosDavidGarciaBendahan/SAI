<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    protected $table ="oficina";

    protected $fillable = ['id','ofi_tipo','ofi_direccion','ofi_fk_parroquia'];
}
