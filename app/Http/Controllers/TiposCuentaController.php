<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TiposCuenta;

class TiposCuentaController extends Controller
{

    public function list(Request $request) {
        if($request->ajax()) {
            $tiposcuenta = TiposCuenta::all();
            
            return $tiposcuenta;
        }
    }

    public function find(Request $request, $id) {
        if($request->ajax()) {
            $tiposcuenta = TiposCuenta::find($id);
    
            return $tiposcuenta;
        }
    }
}
