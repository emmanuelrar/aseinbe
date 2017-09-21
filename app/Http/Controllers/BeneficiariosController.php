<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficiarios;

class BeneficiariosController extends Controller
{
    
    public function getBeneficiarios(Request $request, $cedula) {

        if($request->ajax()) {
            $beneficiarios = Beneficiarios::where('cedula_empleado', $cedula)
            ->get();

        return $beneficiarios;
        }
    }

    public function destroy($id) {
        $beneficiarios = Beneficiarios::where('cedula', $id)
        ->first();
        
        $beneficiarios->delete();

        return response()->json(['response' => 'success']);
    }
}
