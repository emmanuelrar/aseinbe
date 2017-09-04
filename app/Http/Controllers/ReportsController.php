<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kdxemp;
use App\Empleados;

class ReportsController extends Controller
{

    public function captura() {
        $captura = new Kdxemp();
        
        $planilla = $captura->getCapturaPlanilla();
        
        return view('reports.capturaplanilla', compact('planilla'));
    }

    public function prestamos(Request $request, $from = '', $to = '') {
        $reporte = new Kdxemp();
        
        $prestamos = $reporte->getPrestamos($from, $to);

        if( $request->ajax() ) {
            return $prestamos;
        } else {
            return view('reports.prestamos', compact('prestamos'));
        }
    }
}
