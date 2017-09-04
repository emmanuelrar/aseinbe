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
    });

    Route::group(['prefix' => 'creditos'], function() {
        Route::get('creditos', 'CreditsController@index')->name('creditos');
    });

    Route::group(['prefix' => 'reporte'], function() {
        Route::get('captura', 'ReportsController@captura')->name('captura-planilla');
        Route::get('prestamos/{from?}/{to?}', 'ReportsController@prestamos')->name('reporte-prestamos');
    });
});
