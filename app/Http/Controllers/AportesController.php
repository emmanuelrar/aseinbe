<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aportes;
use App\Empleados;
use App\Configuracion;
use Carbon\Carbon;

class AportesController extends Controller
{
    
    public function index() {
        $count = Empleados::where('activo', '1')->count();
        
        $aportes = Aportes::join('empleados', 'empleados.cedula', 'aportes.cedula_empleado')
        ->orderBy('aportes.fecha', 'DESC')
        ->limit($count)
        ->get();

        return view('employees.aportes', compact('aportes'));
    }

    public function registrarAportes(Request $request) {
        
        if($request->ajax()) {
            $empleados = Empleados::where('activo', '1')
            ->get();

            $configuracion = Configuracion::first();
    
            for($i = 0; $i < count($empleados); $i++) {
                if($empleados[$i]->salario > 0) {
                    $aportes = new Aportes();
                    $aportes->cedula_empleado = $empleados[$i]->cedula;
                    $aportes->fecha = Carbon::now();
                    $aportes->aporte_obrero = $empleados[$i]->salario * $configuracion->porcen_aporte_obrero / 100;
                    $aportes->aporte_patron = $empleados[$i]->salario * $configuracion->porcen_aporte_patron / 100;
                    $aportes->save();
                }
            }
        }
    }
}
