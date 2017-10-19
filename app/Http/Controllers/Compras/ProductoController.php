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
        $post = Producto::findOrFail($id);

        return view('admin.Compras.producto.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Producto::findOrFail($id);

        return view('admin.Compras.producto.edit', compact('post'));
    }

    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $post = Producto::findOrFail($id);
        $post->update($requestData);


        return redirect('admin/producto');
    }

    public function destroy($id)
    {
        Producto::destroy($id);


        return redirect('admin/producto');
    }
}
