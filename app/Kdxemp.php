<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Empleados;
use Carbon\Carbon;

class Kdxemp extends Model
{
    protected $table = 'kdxemp';

    public function getCapturaPlanilla() {
        $planilla = Kdxemp::join('empleados', 'empleados.codigo', 'kdxemp.codigo')
        ->where('empleados.liquidado', '=', '0')
        ->groupBy('kdxemp.codigo')
        ->get();

        return $planilla;
    }

    public function getPrestamos($fromDate, $toDate) {

        if($fromDate === '' || $toDate === '') {
            $from = Carbon::now()->subMonths(4)->startOfMonth();
            $to = Carbon::now()->subMonths(4)->endOfMonth();
        } else {
            $from = $fromDate;
            $to = $toDate;
        }

        $prestamos = Kdxemp::selectRaw('MAX(kdxemp.consec) as consec, kdxemp.codigo, empleados.cedula, empleados.nombre, kdxemp.monto_cxc, kdxemp.fecha')
        ->join('empleados', 'empleados.codigo', 'kdxemp.codigo')
        ->where('empleados.liquidado', '=', '0')
        ->where('kdxemp.consec', '>', '0')
        ->where('kdxemp.fecha', '>=', $from)
        ->where('kdxemp.fecha', '<=', $to)
        ->groupBy('kdxemp.codigo')
        ->get();

        return $prestamos;
    }

    public function getDividendos($toDate) {

        if($toDate === '') {
            $to = Carbon::now();
        } else {
            $to = $toDate;
        }

        $dividendos = Kdxemp::selectRaw('CASE empleados.liquidado WHEN 1 THEN empleados.dividen_year ELSE 0 END as pagado, CASE empleados.liquidado WHEN 0 THEN empleados.dividen_year ELSE 0 END as pagar, empleados.dividen_year, empleados.cedula, empleados.codigo, empleados.nombre, kdxemp.fecha')
        ->join('empleados', 'empleados.codigo', 'kdxemp.codigo')
        ->where('kdxemp.fecha', '=', $to)
        ->orderBy('kdxemp.fecha', 'DESC')
        ->groupBy('kdxemp.codigo')
        ->get();

        return $dividendos;
    }

    public function getAcumulados($toDate) {
        
        if($toDate === '') {
            $to = Carbon::now();
        } else {
            $to = $toDate;
        }

        $acumulados = Kdxemp::join('empleados', 'empleados.codigo', 'kdxemp.codigo')
        ->where('kdxemp.fecha', '=', $to)
        ->orderBy('kdxemp.fecha', 'DESC')
        ->groupBy('kdxemp.codigo')
        ->get();

        return $acumulados;
    }
}
