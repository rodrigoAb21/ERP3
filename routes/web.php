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

Route::get('/admin/editarEmpresa', 'DashboardController@editarEmpresa');
Route::post('/admin/editarEmpresa', 'DashboardController@guardarEmpresa');

// ------------------- SGURIDAD ----------------------------------

Route::post('/register', 'Seguridad\AdminController@crear');
Route::resource('/admin/empleados', 'Seguridad\EmpleadoController');
Route::resource('/admin/cuentaEmpleados', 'Seguridad\CuentaEmpleadoController');









// ------------------- COMPRA ----------------------------------










// ------------------- VENTA ----------------------------------









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
    Route::resource('/admin/categoria','CategoriaClienteController');
    Route::get('/admin/categoria/{id}/beneficios','CategoriaClienteController@beneficios');
    Route::post('/admin/categoria/{id}/agregar','CategoriaClienteController@agregar');
    Route::post('/admin/categoria/{id}/remover','CategoriaClienteController@remover');
    Route::get('/admin/categoria/{id}/destroy','CategoriaClienteController@destroy');


});


