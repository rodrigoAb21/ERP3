<?php

namespace App\Http\Controllers\Movil;
use App\Http\Controllers\Controller;
use App\Modelos\Compras\Producto;
use App\Modelos\CRM\Promocion;
use Illuminate\Support\Facades\Session;

class CatalogoController extends Controller
{
    public function catalogo()
    {
        $productos = $this->getProductosMasVendidos();

        $otrosProductos=$this->getProductos();

        return view('movil.catalogo.catalogo',compact('productos','otrosProductos'));
    }

    private function getProductosMasVendidos()
    {
        return Producto::where('idEmpresa','=',
            Session::get('empresa_id'))
            ->get();
    }

    private function getProductos()
    {
       return Producto::where('idEmpresa','=',
           Session::get('empresa_id'))
            ->get();
    }

    public function promocion()
    {
        $promociones=Promocion::where('idEmpresa','=',Session::get('empresa_id'))->get();

        return view('movil.catalogo.promocion',compact('promociones'));
    }

}
