<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;

class CreditsController extends Controller
{
    
    public function index() {

        $empleados = Empleados::where('cta_banc', '!=', '')
        ->get();
        return view('credits.credits', compact('empleados'));
    }
}
