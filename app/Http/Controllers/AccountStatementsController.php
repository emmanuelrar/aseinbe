<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;
use App\Kdxemp;

class AccountStatementsController extends Controller
{

    public function detallado(Request $request, $codigo = '') {
        $estado = new Kdxemp();

        if($request->ajax()) {
            $detallado = $estado->getEstadoDetallado($codigo);        
        } else {
            $empleados = Empleados::where('cta_banc', '!=', '')
            ->get();
            return view('statements.detallado', compact('empleados'));
        }

        return $detallado;
    }

    public function resumido(Request $request, $codigo = '') {
        $estado = new Kdxemp();

        if($request->ajax()) {
            $detallado = $estado->getEstadoDetallado($codigo);        
        } else {
            $empleados = Empleados::where('cta_banc', '!=', '')
            ->get();
            return view('statements.resumido', compact('empleados'));
        }

        return $detallado;
    }
}
