<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;
use App\Prestamos;
use App\Configuracion;

class PrestamosController extends Controller
{
    
    public function index() {
        $empleados = Empleados::join('saldos', 'saldos.cedula_empleado', 'empleados.cedula')
        ->where('activo', '1')
        ->get();

        return view('credits.credits', compact('empleados'));
    }

    public function insert(Request $request) {
        $prestamos = new Prestamos();
        $tasa = Configuracion::first();

        $prestamos->cedula_empleado = $request->input('cedula');
        $prestamos->monto = $request->input('total_deuda');
        $prestamos->tasa_interes = $tasa->porcen_interes;
        $prestamos->monto_interes = $request->input('interes');
        $prestamos->cuotas = $request->input('cuotas');
        $prestamos->cuotas_restantes = $request->input('cuotas');
        $prestamos->monto_restante = $request->input('total_deuda');
        $prestamos->monto_cuotas = $request->input('monto_cuotas');
        $prestamos->save();

        return response()->json(['message' => 'success']);
    }

    public function lista() {
        $empleados = Empleados::join('saldos', 'saldos.cedula_empleado', 'empleados.cedula')
        ->where('prestamos', '>', '0')
        ->get();

        return view('credits.list', compact('empleados'));
    }

    public function obtenerPrestamos(Request $request, $id) {
        if($request->ajax()) {
            $prestamos = Prestamos::select('prestamos.*', 'empleados.cedula', 'empleados.nombre')
            ->join('empleados', 'empleados.cedula', 'prestamos.cedula_empleado')
            ->get();
            
            return $prestamos;
        }
    }
}
