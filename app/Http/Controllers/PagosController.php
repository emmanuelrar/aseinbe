<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pagos;
use App\Prestamos;
use App\Empleados;

class PagosController extends Controller
{
    
    public function index() {
        $count = Prestamos::count();
        
        $pagos = Pagos::select('prestamos.id', 'prestamos.monto_restante', 'prestamos.monto_cuotas', 'prestamos.cuotas_restantes', 'empleados.nombre', 'empleados.cedula', 'pagos.*')
        ->join('prestamos', 'prestamos.id', 'pagos.prestamos_id')
        ->join('empleados', 'empleados.cedula', 'prestamos.cedula_empleado')
        ->orderBy('fecha', 'DESC')
        ->limit($count)
        ->get();

        return view('credits.pagos', compact('pagos'));
    }

    public function pagar(Request $request) {
        if($request->ajax()) {
            $prestamos = Prestamos::select('prestamos.*', 'empleados.nombre', 'empleados.cedula')
            ->join('empleados', 'empleados.cedula', 'prestamos.cedula_empleado')
            ->where('pagado', '0')
            ->get();

            foreach($prestamos as $index => $value){
                $pagos = new Pagos();
                $pagos->prestamos_id = $value->id;
                $pagos->cuota = $value->monto_cuotas;
                $pagos->numero_cuota = ($value->cuotas - $value->cuotas_restantes) + 1;
                $pagos->amortizado = $value->monto_cuotas - ($value->monto_interes / $value->cuotas);
                $pagos->interes = ($value->monto_interes / $value->cuotas);
                $pagos->save();
            }

            return $prestamos;
        }
    }
}
