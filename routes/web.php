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
Route::get('/admin/mensaje', 'DashboardController@showMensaje');

Route::get('/home', 'DashboardController@vistaAdmin');

Route::get('/admin/editarPerfil/{id}', 'DashboardController@editarPerfil');
Route::post('/admin/editarPerfil/{id}', 'DashboardController@guardarPerfil');

Route::get('/admin/editarCuenta', 'DashboardController@editarCuenta');
Route::post('/admin/editarCuenta', 'DashboardController@guardarCuenta');

Route::get('/admin/editarConfig', 'DashboardController@editarConf');
Route::post('/admin/editarConfig', 'DashboardController@guardarConf');

Route::get('/admin/editarEmpresa', 'DashboardController@editarEmpresa');
Route::post('/admin/editarEmpresa', 'DashboardController@guardarEmpresa');

// ------------------- SEGURIDAD ----------------------------------

Route::post('/register', 'Seguridad\AdminController@crear');

//Route::resource('/admin/empleados', 'Seguridad\EmpleadoController');
//Resource de EmpleadoController
//caso deuso id=1 en la BD ,gest de empleados
Route::post('/admin/empleados', 'Seguridad\EmpleadoController@store');
Route::get('/admin/empleados', 'Seguridad\EmpleadoController@index')->middleware('permisos:3,leer');
Route::get('/admin/empleados/create', 'Seguridad\EmpleadoController@create')->middleware('permisos:3,crear');
Route::delete('/admin/empleados/{id}', 'Seguridad\EmpleadoController@destroy')->middleware('permisos:3,eliminar');
Route::put('/admin/empleados', 'Seguridad\EmpleadoController@update');
Route::get('/admin/empleados/{id}/edit', 'Seguridad\EmpleadoController@edit')->middleware('permisos:3,editar');
Route::get('/admin/empleados/{id}', 'Seguridad\EmpleadoController@show');

Route::resource('/admin/cuentaEmpleados', 'Seguridad\CuentaEmpleadoController');

//Gest. De Permisos
Route::get('/admin/casouso', 'Seguridad\CasousoController@index');
Route::post('/admin/casouso/buscar', 'Seguridad\CasousoController@buscar');
Route::post('/admin/casouso/guardar', 'Seguridad\CasousoController@guardar');

Route::get('/admin/rol', 'Seguridad\RolController@index');
Route::post('/admin/rol/buscar','Seguridad\RolController@buscar');

Route::get('/admin/acciones/{id1}/{id2}', 'Seguridad\RolController@editarAcciones');
Route::post('/admin/actualizar-acciones', 'Seguridad\RolController@actualizarAcciones');
Route::get('/admin/rol/lista-roles', 'Seguridad\RolController@listaRoles');
Route::post('/admin/rol/guardar', 'Seguridad\RolController@guardar');
Route::get('/admin/rol/actualizar-cu/{id}', 'Seguridad\RolController@actualizarCus');
Route::post('/admin/rol/remover-cu', 'Seguridad\RolController@removerCus');
Route::post('/admin/rol/agregar-cu', 'Seguridad\RolController@agregarCus');







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


