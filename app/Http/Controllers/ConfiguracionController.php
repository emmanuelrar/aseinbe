<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuracion;

class ConfiguracionController extends Controller
{

    public function list(Request $request) {
        if($request->ajax()) {
            $configuracion = Configuracion::first();
            
            return $configuracion;
        }
    }
    
    public function index() {
        $configuracion = Configuracion::first();

        return view('configuracion.configuracion', compact('configuracion'));
    }

    public function update(Request $request) {
        $configuracion = Configuracion::first();

        $configuracion->porcen_interes = $request->input('porcentaje_interes');
        $configuracion->porcen_aporte_obrero = $request->input('porcentaje_obrero');
        $configuracion->porcen_aporte_patron = $request->input('porcentaje_patron');
        $configuracion->coutas_maximas = $request->input('coutas_max');
        $configuracion->save();

        return response()->json(['message' => 'success']);
    }
}
