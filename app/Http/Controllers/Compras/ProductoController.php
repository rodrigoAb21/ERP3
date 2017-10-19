<?php

namespace App\Http\Controllers\Compras;

use App\Modelos\Compras\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $productos = Producto::where('nombre', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $productos = Producto::paginate($perPage);
        }

        return view('admin.Compras.producto.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.Compras.producto.create');
    }

    public function store(Request $request)
    {

        $requestData = $request->all();

        Producto::create($requestData);


        return redirect('admin/producto');
    }
    public function show($id)
    {
        $producto = Producto::findOrFail($id);

        return view('admin.Compras.producto.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view('admin.Compras.producto.edit', compact('producto'));
    }

    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $producto = Producto::findOrFail($id);
        $producto->update($requestData);


        return redirect('admin/producto');
    }

    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect('admin/producto');
    }
}
