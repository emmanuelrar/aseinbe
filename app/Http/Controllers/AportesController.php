<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aportes;
use App\Empleados;
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
            $empleados = Empleados::select('empleados.cedula', 'empleados.empresa', 'empleados.salario', 'empresas.id', 'configuracion.porcen_aporte_obrero', 'configuracion.porcen_aporte_patron')
            ->join('empresas', 'empresas.id', 'empleados.empresa')
            ->join('configuracion', 'configuracion.id_empresa', 'empresas.id')
            ->get();
    
            for($i = 0; $i < count($empleados); $i++) {
                $aportes = new Aportes();
                $aportes->cedula_empleado = $empleados[$i]->cedula;
                $aportes->fecha = Carbon::now();
                $aportes->aporte_obrero = ($empleados[$i]->salario / 4) * ($empleados[$i]->porcen_aporte_obrero / 4) / 100;
                $aportes->aporte_patron = ($empleados[$i]->salario / 4) * ($empleados[$i]->porcen_aporte_patron / 4) / 100;
                $aportes->tipo = 'CT';
                $aportes->save();
            }
        }
    }
}
