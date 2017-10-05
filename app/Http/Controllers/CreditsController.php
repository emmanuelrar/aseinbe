<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;

class CreditsController extends Controller
{
    
    public function index() {
        $empleados = Empleados::join('saldos', 'saldos.cedula_empleado', 'empleados.cedula')
        ->get();

        return view('credits.credits', compact('empleados'));
    }
}
