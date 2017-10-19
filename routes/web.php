<?php
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
/*
 * Para asignar el middleware a una ruta se sigue el siguiente esquema:
 * id es el id de la tabla Casouso
 * accion = solo hay 4 acciones (ver la tabla permisos) leer,crear,editar,eliminar
 * Ejemplo: Route::get('empleados', 'EmpleadoController@index')->middleware('permisos:id,accion');
 */

Route::post('/admin/empleados', 'Seguridad\EmpleadoController@store');
Route::get('/admin/empleados', 'Seguridad\EmpleadoController@index')->middleware('permisos:2,leer');
Route::get('/admin/empleados/create', 'Seguridad\EmpleadoController@create')->middleware('permisos:2,crear');
Route::delete('/admin/empleados/{id}', 'Seguridad\EmpleadoController@destroy')->middleware('permisos:2,eliminar');
Route::put('/admin/empleados', 'Seguridad\EmpleadoController@update');
Route::get('/admin/empleados/{id}/edit', 'Seguridad\EmpleadoController@edit')->middleware('permisos:2,editar');
Route::get('/admin/empleados/{id}', 'Seguridad\EmpleadoController@show');

Route::resource('/admin/cuentaEmpleados', 'Seguridad\CuentaEmpleadoController');

//Gest. De Permisos id=5
Route::get('/admin/casouso', 'Seguridad\CasousoController@index')->middleware('permisos:5,leer');
Route::post('/admin/casouso/buscar', 'Seguridad\CasousoController@buscar');
Route::post('/admin/casouso/guardar', 'Seguridad\CasousoController@guardar')->middleware('permisos:5,crear');;

Route::get('/admin/rol', 'Seguridad\RolController@index')->middleware('permisos:6,leer');;
Route::post('/admin/rol/buscar','Seguridad\RolController@buscar');

Route::get('/admin/acciones/{id1}/{id2}', 'Seguridad\RolController@editarAcciones')->middleware('permisos:6,editar');;
Route::post('/admin/actualizar-acciones', 'Seguridad\RolController@actualizarAcciones');
Route::get('/admin/rol/lista-roles', 'Seguridad\RolController@listaRoles')->middleware('permisos:6,leer');
Route::post('/admin/rol/guardar', 'Seguridad\RolController@guardar')->middleware('permisos:6,crear');
Route::get('/admin/rol/actualizar-cu/{id}', 'Seguridad\RolController@actualizarCus');
Route::post('/admin/rol/remover-cu', 'Seguridad\RolController@removerCus')->middleware('permisos:6,editar');;
Route::post('/admin/rol/agregar-cu', 'Seguridad\RolController@agregarCus')->middleware('permisos:6,editar');

Route::get('/admin/bitacora' ,'Seguridad\BitacoraController@index');
Route::get('/admin/bitacora/{id}' ,'Seguridad\BitacoraController@show');
// ------------------- COMPRAS ----------------------------------

Route::resource('/admin/producto','Compras\ProductoController');









// ------------------- VENTAS ----------------------------------
//Route::resource('/admin/clientes', 'Ventas\ClienteController');

Route::post('/admin/clientes', 'Ventas\ClienteController@store');
Route::get('/admin/clientes', 'Ventas\ClienteController@index')->middleware('permisos:14,leer');
Route::get('/admin/clientes/create', 'Ventas\ClienteController@create')->middleware('permisos:14,crear');
Route::delete('/admin/clientes/{id}', 'Ventas\ClienteController@destroy')->middleware('permisos:14,eliminar');
Route::put('/admin/clientes', 'Ventas\ClienteController@update');
Route::get('/admin/clientes/{id}/edit', 'Ventas\ClienteController@edit')->middleware('permisos:14,editar');






// ------------------- CRM ----------------------------------
Route::resource('/admin/beneficios', 'CRM\BeneficioController');
Route::resource('/admin/seguimientos', 'CRM\SeguimientoController');

//Route::resource('/admin/tareas', 'CRM\TareaController');

Route::post('/admin/tareas', 'CRM\TareaController@store');
Route::get('/admin/tareas', 'CRM\TareaController@index')->middleware('permisos:27,leer');
Route::get('/admin/tareas/create', 'CRM\TareaController@create')->middleware('permisos:27,crear');
Route::delete('/admin/tareas/{id}', 'CRM\TareaController@destroy')->middleware('permisos:27,eliminar');
Route::put('/admin/tareas', 'CRM\TareaController@update');
Route::get('/admin/tareas/{id}/edit', 'CRM\TareaController@edit')->middleware('permisos:27,editar');







// ------------------- REPORTES ----------------------------------

Route::get('admin/reportes/ReporteVentas', 'Reportes\ReporteController@index');
Route::post('admin/reportes/ReporteVentas', 'Reportes\ReporteController@ventas');
Route::post('admin/reportes/ReporteVentas/PDF', 'Reportes\ReporteController@ventasPDF');
Route::post('admin/reportes/ReporteVentas/Imprimir', 'Reportes\ReporteController@ventasImprimir');






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


//-----------backup
Route::get('/backup','backupController@index');

Route::get('/backup/restore','backupController@restaurar');

Route::get('/backup/create/{id}','backupController@save');   

// Route::post('/backup/restore','backupController@show');

 Route::get('/backup/backup','backupController@backup');