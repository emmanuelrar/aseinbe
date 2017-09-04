<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;
use Carbon\Carbon;

class EmployeesController extends Controller
{
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $empleados = Empleados::all();
        return view('employees.dashboard', compact('empleados'));
    }

    public function destroy($id) {
        $empleado = Empleados::find($id);
        
        $empleado->delete();

        return response()->json(['response' => 'success']);
    }

    public function update(Request $request) {
        $empleado = Empleados::find($request->input('id'));

        $empleado->nombre = $request->input('nombre');
        $empleado->cedula = $request->input('cedula');
        $empleado->cta_banc = $request->input('cta_banc');
        $empleado->telefono = $request->input('telefono');
        $empleado->sexo = $request->input('sexo');
        $empleado->activo = is_null($request->input('activo')) ? '0' : $request->input('activo');
        $empleado->liquidado = is_null($request->input('liquidado')) ? '0' : $request->input('liquidado');
        $empleado->num_hijos = $request->input('num_hijos');
        $empleado->est_civil = $request->input('est_civil');
        $empleado->ced_bene = $request->input('ced_bene');
        $empleado->beneficiario = $request->input('beneficiario');
        $empleado->conyugue = $request->input('conyugue');
        $empleado->fec_naci = Carbon::parse($request->input('fec_naci'));
        $empleado->save();

        return response()->json(['message' => 'success']);
    }

    public function insert(Request $request) {
        $empleado = new Empleados();

        $empleado->nombre = $request->input('nombre');
        $empleado->cedula = $request->input('cedula');
        $empleado->codigo = $request->input('codigo');
        $empleado->cta_banc = $request->input('cta_banc');
        $empleado->telefono = $request->input('telefono');
        $empleado->sexo = $request->input('sexo');
        $empleado->activo = $request->input('activo') === 'on' ? '1' : '0';
        $empleado->liquidado = $request->input('liquidado') === 'on' ? '1' : '0';
        $empleado->num_hijos = $request->input('num_hijos');
        $empleado->est_civil = $request->input('est_civil');
        $empleado->ced_bene = $request->input('ced_bene');
        $empleado->beneficiario = $request->input('beneficiario');
        $empleado->conyugue = $request->input('conyugue');
        $empleado->ingreso = Carbon::parse($request->input('ingreso'));
        $empleado->fec_naci = Carbon::parse($request->input('fec_naci'));
        $empleado->save();

        return response()->json(['message' => 'success']);
    }
}
