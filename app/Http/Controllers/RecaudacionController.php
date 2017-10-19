<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recaudacion;

class RecaudacionController extends Controller
{
    
    public function index() {
        $recaudacion = Recaudacion::orderBy('año', 'DESC')
        ->get();

        $recaudaciones = Recaudacion::orderBy('año', 'DESC')
        ->limit(200)
        ->offset(1)
        ->get();

        return view('recaudacion.recaudacion', compact('recaudacion', 'recaudaciones'));
    }
}
