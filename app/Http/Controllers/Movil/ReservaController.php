<?php

namespace App\Http\Controllers\Movil;
use App\Http\Controllers\Controller;
use App\Modelos\Compras\NotaCompra;
use App\Modelos\Compras\Producto;
use App\Modelos\Movil\Carrito;
use App\Modelos\Ventas\Cliente;
use App\Modelos\Ventas\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservaController extends Controller
{
        //Session::get('cliente_id')
    //Session::get('empresa_id')
    public function canjear($id)
    {
        $this->verificarCanjeo($id);
        return        redirect('movil/catalogo');


    }

    public function verificarCanjeo($id)
    {
        $cliente=Cliente::find(Session::get('cliente_id'));
        $producto=Producto::find($id);
        if($cliente->puntosAcumulados>=$producto->puntosEquivale)
        {

            $cliente->puntosAcumulados=$cliente->puntosAcumulados-$producto->puntosEquivale;
            $carrito = new Carrito();
            $carrito->cliente_id=$cliente->id;
            $carrito->producto_id=$producto->id;
            $carrito->cantidad=1;
            $carrito->pagado=1;
            $carrito->save();
            Session::put('puntos',$cliente->puntosAcumulados);
            $cliente->update();
        }
    }
    public function reservar($id)
    {
        $this->verificarReserva($id);
        return        redirect('movil/catalogo');

    }

    public function verificarReserva($id)
    {
        $cliente=Cliente::find(Session::get('cliente_id'));
        $producto=Producto::find($id);
        if($cliente->puntosAcumulados>=$producto->puntosEquivale)
        {

            $cliente->puntosAcumulados=$cliente->puntosAcumulados-$producto->puntosEquivale;
            $carrito = new Carrito();
            $carrito->cliente_id=$cliente->id;
            $carrito->producto_id=$producto->id;
            $carrito->cantidad=1;
            $carrito->pagado=0;
            $carrito->save();
            //Session::put('puntos',$cliente->puntosAcumulados);

        }
    }

    public function carrito()
    {

        $productos=$this->getAllwhere();
        return view('movil.catalogo.carrito',compact('productos'));

    }

    public function getAllwhere()
    {
        $cliente=Cliente::find(Session::get('cliente_id'));
         return $cliente->carrito;

    }



}
