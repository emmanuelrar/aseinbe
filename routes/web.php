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
        return view('home.home');
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
        Route::get('aportes', 'EmployeesController@aportes')->name('aportes');
        Route::get('beneficiario/{id}', 'BeneficiariosController@getBeneficiarios')->name('beneficiarios');
        Route::get('beneficiario/eliminar/{id}', 'BeneficiariosController@destroy')->name('beneficiarios-eliminar');        
    });

    Route::group(['prefix' => 'creditos'], function() {
        Route::get('creditos', 'CreditsController@index')->name('creditos');
    });

    Route::group(['prefix' => 'estados'], function() {
        Route::get('detallado/{id?}', 'AccountStatementsController@detallado')->name('detallado');
        Route::get('resumido/{id?}', 'AccountStatementsController@resumido')->name('resumido');
    });

    Route::group(['prefix' => 'reporte'], function() {
        Route::get('captura', 'ReportsController@captura')->name('captura-planilla');
        Route::get('prestamos/{from?}/{to?}', 'ReportsController@prestamos')->name('reporte-prestamos');
        Route::get('dividendos/{to?}', 'ReportsController@dividendos')->name('dividendos');
        Route::get('acumulados/{to?}', 'ReportsController@acumulados')->name('acumulados');
    });
});
