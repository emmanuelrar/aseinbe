<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;
use App\Beneficiarios;
use Carbon\Carbon;

class EmployeesController extends Controller
{
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
        $empleado = Empleados::find($request->input('codigo'));

        $empleado->nombre = $request->input('nombre');
        $empleado->cedula = $request->input('cedula');
        $empleado->telefono = $request->input('telefono');
        $empleado->codigo = $request->input('codigo');
        $empleado->cta_banc = $request->input('cta_banc');
        $empleado->salario = $request->input('salario');
        $empleado->estado_civil = $request->input('estado_civil');
        $empleado->fecha_nacimiento = Carbon::parse($request->input('fecha_nacimiento'));
        $empleado->fecha_ingreso = Carbon::parse($request->input('fecha_ingreso'));
        $empleado->nacionalidad = $request->input('nacionalidad');
        $empleado->activo = $request->input('activo') === 'on' ? '1' : '0';
        $empleado->liquidado = $request->input('liquidado') === 'on' ? '1' : '0';
        $empleado->conyugue = $request->input('conyugue');
        $empleado->hijos = $request->input('hijos');
        $empleado->sexo = $request->input('sexo');
        $empleado->save();

        if(count($request->input('nombre_beneficiario')) > 0) {
            for($i = 0; $i < count($request->input('nombre_beneficiario')); $i++) {
                if(!is_null($request->input('nombre_beneficiario')) && !is_null($request->input('cedula_beneficiario')) && !is_null($request->input('parentesco'))) {
                    $beneficiario = Beneficiarios::find($request->input('id.'.$i));
                    $beneficiario->codigo = $request->input('codigo');
                    $beneficiario->nombre = $request->input('nombre_beneficiario.'.$i);
                    $beneficiario->cedula = $request->input('cedula_beneficiario.'.$i);
                    $beneficiario->parentesco = $request->input('parentesco.'.$i);
                    $beneficiario->save();
                }
            }
        }

        return response()->json(['message' => 'success']);
    }

    public function insert(Request $request) {
        $empleado = new Empleados();

        if(count($request->input('nombre_beneficiario')) > 0) {
            for($i = 0; $i < count($request->input('nombre_beneficiario')); $i++) {
                if(is_null($request->input('nombre_beneficiario')) && is_null($request->input('cedula_beneficiario')) && is_null($request->input('parentesco'))) {
                    $beneficiario = new Beneficiarios();        
                    $beneficiario->codigo = $request->input('codigo');
                    $beneficiario->nombre = $request->input('nombre_beneficiario.'.$i);
                    $beneficiario->cedula = $request->input('cedula_beneficiario.'.$i);
                    $beneficiario->parentesco = $request->input('parentesco.'.$i);
                    $beneficiario->save();
                }
            }
        }

        $empleado->nombre = $request->input('nombre');
        $empleado->cedula = $request->input('cedula');
        $empleado->telefono = $request->input('telefono');
        $empleado->codigo = $request->input('codigo');
        $empleado->cta_banc = $request->input('cta_banc');
        $empleado->salario = $request->input('salario');
        $empleado->estado_civil = $request->input('estado_civil');
        $empleado->fecha_nacimiento = Carbon::parse($request->input('fecha_nacimiento'));
        $empleado->fecha_ingreso = Carbon::parse($request->input('fecha_ingreso'));
        $empleado->nacionalidad = $request->input('nacionalidad');
        $empleado->activo = $request->input('activo') === 'on' ? '1' : '0';
        $empleado->liquidado = $request->input('liquidado') === 'on' ? '1' : '0';
        $empleado->conyugue = $request->input('conyugue');
        $empleado->hijos = $request->input('hijos');
        $empleado->sexo = $request->input('sexo');
        $empleado->save();

        return response()->json(['message' => 'success']);
    }

    // public function aportes() {
    //     $empleados = Empleados::all();
    //     return view('employees.aportes', compact('empleados'));
    // }
}
