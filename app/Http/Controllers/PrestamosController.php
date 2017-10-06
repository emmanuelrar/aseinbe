<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;
use App\Prestamos;

class PrestamosController extends Controller
{
    
    public function index() {
        $empleados = Empleados::join('saldos', 'saldos.cedula_empleado', 'empleados.cedula')
        ->get();

        return view('credits.credits', compact('empleados'));
    }

    public function insert(Request $request) {
        $prestamos = new Prestamos();

        $prestamos->cedula_empleado = $request->input('cedula');
        $prestamos->monto = $request->input('monto');
        $prestamos->tasa_interes = $request->input('tasa_interes');
        $prestamos->monto_interes = $request->input('monto_interes');
        $prestamos->cuotas = $request->input('cuotas');
        $prestamos->cuotas_restantes = $request->input('cuotas_restantes');
        $prestamos->fecha_final = Carbon::now();
        $prestamos->save();

        return response()->json(['message' => 'success']);
    }
}
