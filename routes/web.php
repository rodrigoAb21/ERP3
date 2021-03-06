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

Route::get('admin/cuentaEmpleados', 'Seguridad\CuentaEmpleadoController@index')->middleware('permisos:2,leer');;
Route::get('admin/cuentaEmpleados/{id}/edit', 'Seguridad\CuentaEmpleadoController@edit')->middleware('permisos:2,editar');
Route::post('admin/cuentaEmpleados/{id}', 'Seguridad\CuentaEmpleadoController@update');



Route::get('/admin/casouso', 'Seguridad\CasousoController@index');
Route::post('/admin/casouso/buscar', 'Seguridad\CasousoController@buscar');

Route::get('/admin/rol', 'Seguridad\RolController@index')->middleware('permisos:3,leer');;
Route::post('/admin/rol/buscar','Seguridad\RolController@buscar');

Route::get('/admin/acciones/{id1}/{id2}', 'Seguridad\RolController@editarAcciones')->middleware('permisos:3,editar');
Route::post('/admin/actualizar-acciones', 'Seguridad\RolController@actualizarAcciones');
Route::get('/admin/rol/lista-roles', 'Seguridad\RolController@listaRoles')->middleware('permisos:3,leer');
Route::post('/admin/rol/guardar', 'Seguridad\RolController@guardar')->middleware('permisos:3,crear');
Route::get('/admin/rol/actualizar-cu/{id}', 'Seguridad\RolController@actualizarCus')->middleware('permisos:3,editar');
Route::post('/admin/rol/remover-cu', 'Seguridad\RolController@removerCus');
Route::post('/admin/rol/agregar-cu', 'Seguridad\RolController@agregarCus');

Route::get('/admin/bitacora' ,'Seguridad\BitacoraController@index');
Route::get('/admin/bitacora/{id}' ,'Seguridad\BitacoraController@show');
// ------------------- COMPRAS ----------------------------------

Route::post('/admin/productos', 'Compras\ProductoController@store');
Route::get('/admin/productos', 'Compras\ProductoController@index')->middleware('permisos:8,leer');
Route::get('/admin/productos/create', 'Compras\ProductoController@create')->middleware('permisos:8,crear');
Route::delete('/admin/productos/{id}', 'Compras\ProductoController@destroy')->middleware('permisos:8,eliminar');
Route::put('/admin/productos', 'Compras\ProductoController@update');
Route::get('/admin/productos/{id}/edit', 'Compras\ProductoController@edit')->middleware('permisos:8,editar');


Route::post('/admin/proveedores', 'Compras\ProveedorController@store');
Route::get('/admin/proveedores', 'Compras\ProveedorController@index')->middleware('permisos:7,leer');
Route::get('/admin/proveedores/create', 'Compras\ProveedorController@create')->middleware('permisos:7,crear');
Route::delete('/admin/proveedores/{id}', 'Compras\ProveedorController@destroy')->middleware('permisos:7,eliminar');
Route::put('/admin/proveedores', 'Compras\ProveedorController@update');
Route::get('/admin/proveedores/{id}/edit', 'Compras\ProveedorController@edit')->middleware('permisos:7,editar');


Route::post('/admin/categoriaProducto', 'Compras\CategoriaProductoController@store');
Route::get('/admin/categoriaProducto', 'Compras\CategoriaProductoController@index')->middleware('permisos:9,leer');
Route::get('/admin/categoriaProducto/create', 'Compras\CategoriaProductoController@create')->middleware('permisos:9,crear');
Route::delete('/admin/categoriaProducto/{id}', 'Compras\CategoriaProductoController@destroy')->middleware('permisos:9,eliminar');
Route::put('/admin/categoriaProducto', 'Compras\CategoriaProductoController@update');
Route::get('/admin/categoriaProducto/{id}/edit', 'Compras\CategoriaProductoController@edit')->middleware('permisos:9,editar');


Route::post('/admin/tipos', 'Compras\TipoController@store');
Route::get('/admin/tipos', 'Compras\TipoController@index')->middleware('permisos:9,leer');
Route::get('/admin/tipos/create', 'Compras\TipoController@create')->middleware('permisos:9,crear');
Route::delete('/admin/tipos/{id}', 'Compras\TipoController@destroy')->middleware('permisos:9,eliminar');
Route::put('/admin/tipos', 'Compras\TipoController@update');
Route::get('/admin/tipos/{id}/edit', 'Compras\TipoController@edit')->middleware('permisos:9,editar');


Route::get('admin/notacompra','Compras\NotaCompraController@index')->middleware('permisos:10,leer');
Route::get('admin/notacompra/show/{id}','Compras\NotaCompraController@show');
Route::get('admin/notacompra/create','Compras\NotaCompraController@create')->middleware('permisos:10,crear');
Route::get('admin/notacompra/store','Compras\NotaCompraController@store');

Route::get('admin/ingreso/{notacompra}','Compras\IngresoController@reabastecer');
Route::post('admin/ingreso','Compras\IngresoController@guardar');

Route::get('admin/inventario','Compras\InventarioController@index')->middleware('permisos:11,leer');
Route::get('admin/showPromociones/{idProducto}','Compras\InventarioController@showPromociones');





// ------------------- VENTAS ----------------------------------


Route::post('/admin/clientes', 'Ventas\ClienteController@store');
Route::get('/admin/clientes', 'Ventas\ClienteController@index')->middleware('permisos:14,leer');
Route::get('/admin/clientes/create', 'Ventas\ClienteController@create')->middleware('permisos:14,crear');
Route::delete('/admin/clientes/{id}', 'Ventas\ClienteController@destroy')->middleware('permisos:14,eliminar');
Route::put('/admin/clientes', 'Ventas\ClienteController@update');
Route::get('/admin/clientes/{id}/edit', 'Ventas\ClienteController@edit')->middleware('permisos:14,editar');

Route::post('/admin/puntosVenta', 'Ventas\PuntoController@store');
Route::get('/admin/puntosVenta', 'Ventas\PuntoController@index')->middleware('permisos:13,leer');
Route::get('/admin/puntosVenta/create', 'Ventas\PuntoController@create')->middleware('permisos:13,crear');
Route::delete('/admin/puntosVenta/{id}', 'Ventas\PuntoController@destroy')->middleware('permisos:13,eliminar');
Route::put('/admin/puntosVenta', 'Ventas\PuntoController@update');
Route::get('/admin/puntosVenta/{id}/edit', 'Ventas\PuntoController@edit')->middleware('permisos:13,editar');


Route::get('/admin/garantes', 'Ventas\GaranteController@index')->middleware('permisos:19,leer');
Route::delete('/admin/garantes/{id}', 'Ventas\GaranteController@destroy')->middleware('permisos:19,eliminar');
Route::get('/admin/garantes/{id}', 'Ventas\GaranteController@show');
Route::put('/admin/garantes', 'Ventas\GaranteController@update');
Route::get('/admin/garantes/{id}/edit', 'Ventas\GaranteController@edit')->middleware('permisos:19,editar');
Route::get('/admin/garantes/{id}/edit', 'Ventas\GaranteController@edit')->middleware('permisos:19,editar');

Route::resource('/admin/pagos', 'Ventas\PagoController');
Route::resource('/admin/creditos', 'Ventas\CreditoController');

Route::get('admin/creditos/{id}/cuotas','Ventas\CuotaController@index');
Route::post('admin/creditos/{id}/cuotas', 'Ventas\CuotaController@pagar');


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


Route::get('admin/seguimientos','CRM\SeguimientoController@index')->middleware('permisos:26,leer');
Route::get('admin/seguimientos/cliente/{cliente}','CRM\SeguimientoController@cliente');
Route::post('admin/seguimientos','CRM\SeguimientoController@store')->middleware('permisos:26,crear');

Route::get('admin/asignacion/{id}','CRM\AsignacionController@index');
Route::post('admin/asignacion/{id}','CRM\AsignacionController@store');
Route::get('admin/asignacion/destroy/{tarea}/{seguimiento}','CRM\AsignacionController@destroy');



Route::post('/admin/posiblesClientes', 'CRM\PClienteController@store');
Route::get('/admin/posiblesClientes', 'CRM\PClienteController@index')->middleware('permisos:25,leer');
Route::get('/admin/posiblesClientes/create', 'CRM\PClienteController@create')->middleware('permisos:25,crear');
Route::delete('/admin/posiblesClientes/{id}', 'CRM\PClienteController@destroy')->middleware('permisos:25,eliminar');
Route::put('/admin/posiblesClientes', 'CRM\PClienteController@update');
Route::get('/admin/posiblesClientes/{id}/edit', 'CRM\PClienteController@edit')->middleware('permisos:25,editar');
Route::put('/admin/posiblesClientes/{id}', 'CRM\PClienteController@promover');

Route::get('admin/categoria', 'CRM\CategoriaClienteController@index')->middleware('permisos:14,leer');
Route::get('admin/categoria/create', 'CRM\CategoriaClienteController@create')->middleware('permisos:14,crear');
Route::get('admin/categoria/{id}/edit', 'CRM\CategoriaClienteController@edit')->middleware('permisos:14,editar');
Route::delete('admin/categoria/{id}', 'CRM\CategoriaClienteController@destroy')->middleware('permisos:14,eliminar');
Route::POST('admin/categoria/{id}', 'CRM\CategoriaClienteController@update');
Route::post('/admin/categoria', 'CRM\CategoriaClienteController@store');

Route::get('admin/promocion', 'CRM\PromocionController@index')->middleware('permisos:23,leer');
Route::get('admin/promocion/create', 'CRM\PromocionController@create')->middleware('permisos:23,crear');
Route::post('admin/promocion', 'CRM\PromocionController@store');
Route::get('admin/promocion/{id}/edit', 'CRM\PromocionController@edit')->middleware('permisos:23,editar');
Route::post('admin/promocion/update', 'CRM\PromocionController@update');
Route::get('admin/promocion/{id}/delete', 'CRM\PromocionController@destroy')->middleware('permisos:23,eliminar');
Route::get('admin/promocion/{id}/editarProductos', 'CRM\DetallePromoController@editarProductos');
Route::post('admin/promocion/actualizarPrecio', 'CRM\DetallePromoController@actualizarPrecio');
Route::post('admin/promocion/{promo}/remover', 'CRM\DetallePromoController@remover');
Route::post('admin/promocion/{promo}/agregar', 'CRM\DetallePromoController@agregar');

Route::get('admin/categoriaCliente/{id}/beneficios','CRM\CategoriaBeneficioController@editarBeneficios');
Route::post('admin/categoriaCliente/{id}/agregar','CRM\CategoriaBeneficioController@agregar');
Route::post('admin/categoriaCliente/{id}/remover','CRM\CategoriaBeneficioController@remover');

Route::get('admin/categoriaCliente/{id}/promociones','CRM\CategoriaPromocionController@editarPromociones');
Route::post('admin/categoriaCliente/{id}/agregarPromo','CRM\CategoriaPromocionController@agregarPromo');
Route::post('admin/categoriaCliente/{id}/removerPromo','CRM\CategoriaPromocionController@removerPromo');



// ------------------- REPORTES ----------------------------------

Route::get('admin/reportes/ReporteVentas', 'Reportes\ReporteController@index');
Route::post('admin/reportes/ReporteVentas', 'Reportes\ReporteController@ventas');

Route::get('admin/reportes/ReporteStocks', 'Reportes\ReporteController@stockIndex');
Route::post('admin/reportes/ReporteStocks', 'Reportes\ReporteController@stock');
Route::get('admin/reportes/ReporteStocks2/PDF', 'Reportes\ReporteController@stockPDF2');
Route::get('admin/reportes/ReporteStocks/PDF/{id}', 'Reportes\ReporteController@stockPDF');





//-----------backup
Route::get('/backup','backupController@index');

Route::get('/backup/restore','backupController@restaurar');

Route::get('/backup/create/{id}','backupController@save');

// Route::post('/backup/restore','backupController@show');

Route::get('/backup/backup','backupController@backup');

//------------------------- MOVIL ----------------------------
Route::get('movil/login/empresa/{id}','Movil\LoginController@empresa');

Route::get('movil/cliente/registro','Movil\ClienteController@create');
Route::post('movil/cliente/store', 'Movil\ClienteController@store');

Route::get('movil/login', 'Movil\LoginController@login');
Route::get('movil/login/salir', 'Movil\LoginController@login');
Route::post('movil/login/ingresar', 'Movil\LoginController@ingresar');

Route::get('movil/catalogo', 'Movil\CatalogoController@catalogo');
Route::get('movil/promocion', 'Movil\CatalogoController@promocion');

Route::get('movil/canjear/{id}', 'Movil\ReservaController@canjear');
Route::get('movil/reservar/{id}', 'Movil\ReservaController@reservar');

Route::get('movil/carrito', 'Movil\ReservaController@carrito');
Route::get('movil/carrito/finalizar', 'Movil\ReservaController@finalizar');


