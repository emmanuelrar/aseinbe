<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresas;

class EmpresasController extends Controller
{
    public function list(Request $request) {
        if($request->ajax()) {
            $empresas = Empresas::all();
            
            return $empresas;
        }
    }
}
