<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saldos;

class SaldosController extends Controller
{
    
    public function saldos(Request $request, $id) {
        $saldos = new Saldos();
        if($request->ajax()) {

            $saldo = $saldos->getSaldos($id);

            return $saldo;
        }
    }
}
