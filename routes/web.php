<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('employees');
    } else {
        return view('auth.login');
    }
})->name('index');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('employees', 'EmployeesController@index')->name('employees');

    Route::group(['prefix' => 'empleado'], function() {
        Route::get('delete/{id}', 'EmployeesController@destroy');
        Route::post('update', 'EmployeesController@update')->name('update-employee');
        Route::post('insert', 'EmployeesController@insert')->name('insert-employee');
        Route::get('beneficiario/{id}', 'BeneficiariosController@getBeneficiarios')->name('beneficiarios');
        Route::get('beneficiario/eliminar/{id}', 'BeneficiariosController@destroy')->name('beneficiarios-eliminar');        
        Route::get('saldos/{id}', 'SaldosController@saldos')->name('saldos-empleado');
    });

    Route::group(['prefix' => 'cuenta'], function() {
        Route::get('tipos', 'TiposCuentaController@list')->name('tiposcuenta-empleado');
        Route::get('find/{id}', 'TiposCuentaController@find')->name('find-tipocuenta');
    });

    Route::group(['prefix' => 'aportes'], function() {
        Route::get('/', 'AportesController@index')->name('aportes');
        Route::get('registrar', 'AportesController@registrarAportes')->name('registrar-aportes');
    });

    Route::group(['prefix' => 'empresas'], function() {
        Route::get('/', 'EmpresasController@index')->name('empresas');
        Route::get('list', 'EmpresasController@list')->name('lista-empresas');
        Route::get('find/{id}', 'EmpresasController@find')->name('find-empresas');
        Route::post('insert', 'EmpresasController@insert')->name('insert-empresas');
        Route::post('update/{id}', 'EmpresasController@update')->name('update-empresas');
        Route::get('delete/{id}', 'EmpresasController@destroy')->name('delete-empresas');        
    });

    Route::group(['prefix' => 'creditos'], function() {
        Route::get('creditos', 'CreditsController@index')->name('creditos');
    });

    Route::group(['prefix' => 'estados'], function() {
        Route::get('detallado/{id?}', 'AccountStatementsController@detallado')->name('detallado');
        Route::get('resumido/{id?}', 'AccountStatementsController@resumido')->name('resumido');
    });

    Route::group(['prefix' => 'configuracion'], function() {
        Route::get('/', 'ConfiguracionController@index')->name('configuracion');
        Route::post('update', 'ConfiguracionController@update')->name('update-configuracion');
    });

    Route::group(['prefix' => 'reporte'], function() {
        Route::get('captura', 'ReportsController@captura')->name('captura-planilla');
        Route::get('prestamos/{from?}/{to?}', 'ReportsController@prestamos')->name('reporte-prestamos');
        Route::get('dividendos/{to?}', 'ReportsController@dividendos')->name('dividendos');
        Route::get('acumulados/{to?}', 'ReportsController@acumulados')->name('acumulados');
    });
});
