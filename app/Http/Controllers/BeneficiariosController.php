<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficiarios;

class BeneficiariosController extends Controller
{
    
    public function getBeneficiarios(Request $request, $codigo) {

        if($request->ajax()) {
            $beneficiarios = Beneficiarios::where('codigo', $codigo)
            ->get();

        return $beneficiarios;
        }
    }
}
