<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresas;

class EmpresasController extends Controller
{
    public function lista(Request $request) {
        if($request->ajax()) {
            $empresas = Empresas::all();
            
            return $empresas;
        }
    }

    public function find(Request $request, $id) {
        if($request->ajax()) {
            $empresa = Empresas::find($id);
    
            return $empresa;
        }
    }

    public function index() {
        $empresas = Empresas::all();

        return view('companies.companies', compact('empresas'));
    }

    public function insert(Request $request) {
        $empresa = new Empresas();

        $empresa->nombre = $request->input('nombre');
        $empresa->save();

        return response()->json(['message' => 'success']);
    }

    public function update(Request $request, $id) {
        $empresa = Empresas::find($id);
        
        $empresa->nombre = $request->input('nombre');
        $empresa->save();

        return response()->json(['message' => 'success']);
    }

    public function destroy(Request $request, $id) {
        if($request->ajax()) {
            $empresa = Empresas::find($id);

            $empresa->delete();

            return response()->json(['message' => 'success']);
        }
    }
}
