<?php
namespace App;


class Utils
{
    public static $ACTION_LISTAR='VER';
    public static $ACTION_CREATE='CREAR';
    public static $ACTION_UPDATE='ACTUALIZAR';
    public static $ACTION_DELETE='ELIMINAR';


    public static $BITACORA_ID_SESSION='BITACORA_ID';


    public static $TABLA_EMPLEADO='empleado';
    public static $TABLA_CLIENTE='cliente';
    public static $TABLA_SEGUIMIENTO='seguimiento';
    public static $TABLA_TAREA='tarea';
    
    public static $TABLA_PROVEEDOR='proveedor';
    public static $TABLA_CATEGORIA_PRODUCTO='categoria_producto';
    public static $TABLA_TIPO='tipo';
    public static $TABLA_PRODUCTO='producto';
    public static $TABLA_CUENTA_EMPLEADO='cuenta.empleado';
    public static $TABLA_PUNTO='punto_de_venta';
    public static $TABLA_PAGO='pago_contado';
    public static $TABLA_GARANTE='garante';
    public static $TABLA_CREDITO='pago_credito';
    public static $TABLA_CUOTA='Cuota';

//Bitacora::registrarListar(Utils::$TABLA_EMPLEADO);
//Bitacora::registrarCreate( Utils::$TABLA_EMPLEADO,$empleado->id
//Bitacora::registrarUpdate( Utils::$TABLA_EMPLEADO,$empleado->id);
//Bitacora::registrarDelete(Utils::$TABLA_EMPLEADO,$id);

}
