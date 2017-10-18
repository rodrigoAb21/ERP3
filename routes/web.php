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

/* VISTA INICIAL */
Route::get('/', function () {
    return view('vistaPrincipal.home');
});

Route::get('/about', function () {
    return view('vistaPrincipal.about');
});

Route::get('/contact', function () {
    return view('vistaPrincipal.contact');
});

Route::get('/services', function () {
    return view('vistaPrincipal.services');
});

// nuevo cambio



/* VISTA ADMIN */


Auth::routes();



// ----------------- DASHBOARD -------------------------------

Route::get('/admin', 'DashboardController@vistaAdmin');
Route::get('/home', 'DashboardController@vistaAdmin');

Route::get('/admin/editarPerfil/{id}', 'DashboardController@editarPerfil');
Route::post('/admin/editarPerfil/{id}', 'DashboardController@guardarPerfil');

Route::get('/admin/editarCuenta', 'DashboardController@editarCuenta');
Route::post('/admin/editarCuenta', 'DashboardController@guardarCuenta');

Route::get('/admin/editarConfig', 'DashboardController@editarConf');
Route::post('/admin/editarConfig', 'DashboardController@guardarConf');

Route::get('/admin/editarEmpresa', 'DashboardController@editarEmpresa');
Route::post('/admin/editarEmpresa', 'DashboardController@guardarEmpresa');

// ------------------- SGURIDAD ----------------------------------

Route::post('/register', 'Seguridad\AdminController@crear');

//Route::resource('/admin/empleados', 'Seguridad\EmpleadoController');
//Resource de EmpleadoController
//caso deuso id=1 gest de empleados
Route::post('/admin/empleados', 'EmpleadoController@store');
Route::get('/admin/empleados', 'EmpleadoController@index')->middleware('permisos:1,leer');
Route::get('/admin/empleados/create', 'EmpleadoController@create')->middleware('permisos:1,crear');
Route::delete('/admin/empleados/{id}', 'EmpleadoController@destroy')->middleware('permisos:1,eliminar');
Route::put('/admin/empleados/{id}', 'EmpleadoController@update');
Route::get('/admin/empleados/{id}/edit', 'EmpleadoController@edit')->middleware('permisos:1,editar');
Route::get('/admin/empleados/{id}', 'EmpleadoController@show');

Route::resource('/admin/cuentaEmpleados', 'Seguridad\CuentaEmpleadoController');










// ------------------- COMPRAS ----------------------------------










// ------------------- VENTAS ----------------------------------
Route::resource('/admin/clientes', 'Ventas\ClienteController');








// ------------------- CRM ----------------------------------
Route::resource('/admin/beneficios', 'CRM\BeneficioController');
Route::resource('/admin/tareas', 'CRM\TareaController');
Route::resource('/admin/seguimientos', 'CRM\SeguimientoController');








// ------------------- REPORTES ----------------------------------








Route::group(['middleware'=> 'web'],function(){
    Route::resource('/admin/promocion','PromocionController');
    Route::get('/admin/promocion/{id}/productos','PromocionController@productos');
    Route::post('/admin/promocion/{id}/update','PromocionController@update');
    Route::post('/admin/promocion/{id}/edit','PromocionController@edit');
    Route::post('/admin/promocion/{id}/agregarProductos','PromocionController@agregarProductos');
    Route::post('/admin/promocion/{id}/actualizarCantidad','PromocionController@actualizarCantidad');
    Route::post('/admin/promocion/{id}/removerProducto','PromocionController@removerProducto');
});

Route::group(['middleware'=> 'web'],function(){
    Route::resource('/admin/categoria','CRM\CategoriaClienteController');
    Route::get('/admin/categoria/{id}/beneficios','CRM\CategoriaClienteController@beneficios');
    Route::post('/admin/categoria/{id}/agregar','CRM\CategoriaClienteController@agregar');
    Route::post('/admin/categoria/{id}/remover','CRM\CategoriaClienteController@remover');
});


