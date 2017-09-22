<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;
use App\Beneficiarios;
use App\Saldos;
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
        $empleado = Empleados::find($request->input('cedula'));

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
        $empleado->activo = $request->input('activo') == '0' ? '1' : '0';
        $empleado->liquidado = $request->input('liquidado') == '0' ? '1' : '0';
        $empleado->conyugue = $request->input('conyugue');
        $empleado->hijos = $request->input('hijos');
        $empleado->empresa = $request->input('empresa');
        $empleado->sexo = $request->input('sexo');
        $empleado->save();

        if(count($request->input('nombre_beneficiario')) > 0) {
            for($i = 0; $i < count($request->input('nombre_beneficiario')); $i++) {
                if(!is_null($request->input('nombre_beneficiario')) && !is_null($request->input('cedula_beneficiario')) && !is_null($request->input('parentesco'))) {
                    $beneficiario = Beneficiarios::find($request->input('id.'.$i));

                    if(is_null($beneficiario)) {
                        $beneficiario = new Beneficiarios();
                    } 

                    $beneficiario->cedula_empleado = $request->input('cedula');
                    $beneficiario->nombre = $request->input('nombre_beneficiario.'.$i);
                    $beneficiario->cedula = $request->input('cedula_beneficiario.'.$i);
                    $beneficiario->parentesco = $request->input('parentesco.'.$i);
                    $beneficiario->porcentaje = $request->input('porcentaje.'.$i);
                    $beneficiario->save();
                }
            }
        }

        return response()->json(['message' => 'success']);
    }

    public function insert(Request $request) {
        $empleado = new Empleados();
        $saldos = new Saldos();

        if(count($request->input('nombre_beneficiario')) > 0) {
            for($i = 0; $i < count($request->input('nombre_beneficiario')); $i++) {
                if(is_null($request->input('nombre_beneficiario')) && is_null($request->input('cedula_beneficiario')) && is_null($request->input('parentesco'))) {
                    $beneficiario = new Beneficiarios();        
                    $beneficiario->cedula_empleado = $request->input('cedula');
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
        $empleado->activo = $request->input('activo') == '0' ? '1' : '0';
        $empleado->liquidado = $request->input('liquidado') == '0' ? '1' : '0';
        $empleado->conyugue = $request->input('conyugue');
        $empleado->hijos = $request->input('hijos');
        $empleado->empresa = $request->input('empresa');
        $empleado->sexo = $request->input('sexo');
        $empleado->save();

        $saldos->cedula_empleado = $request->input('cedula');
        $saldos->save();

        return response()->json(['message' => 'success']);
    }

}
