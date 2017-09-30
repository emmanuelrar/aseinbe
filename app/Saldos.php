<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saldos extends Model
{
    
    public function getSaldos($id) {
        $saldos = Saldos::where('cedula_empleado', $id)->get();

        return $saldos;
    }
}
