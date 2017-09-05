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

    public function getDividendos() {

        $dividendos = Kdxemp::selectRaw('CASE empleados.liquidado WHEN 1 THEN kdxemp.dividen ELSE 0 END as pagado, CASE empleados.liquidado WHEN 0 THEN kdxemp.dividen ELSE 0 END as pagar, kdxemp.dividen, empleados.cedula, empleados.codigo, empleados.nombre, kdxemp.monto_cxc, kdxemp.fecha')
        ->join('empleados', 'empleados.codigo', 'kdxemp.codigo')
        ->orderBy('kdxemp.fecha', 'DESC')
        ->groupBy('kdxemp.codigo')
        ->get();

        return $dividendos;
    }
}