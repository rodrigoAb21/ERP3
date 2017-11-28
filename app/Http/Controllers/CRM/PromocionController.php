<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Modelos\CRM\DetallePromo;
use App\Modelos\CRM\Promocion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromocionController extends Controller
{
    public function index()
    {
        $title = 'Promociones';
        $promociones = DB::table('promocion')
            ->where('visible','=',1)
            ->where('idEmpresa','=',Auth::user()->idEmpresa)
        ->get();
        return view('admin.CRM.promocion.index',compact('promociones','title'));
    }

    public function create()
    {
        $title = 'Nueva Promocion';

        return view('admin.CRM.promocion.create',compact('title'));
    }
    public function edit($id)
    {
        $promocion=Promocion::findOrFail($id);
        return view ('admin.CRM.promocion.edit',compact('promocion'));
    }
    public function store(Request $request)
    {
        $promocion=new Promocion();
        $promocion->nombre=$request->nombre;
        $promocion->fechaEmpieza=$request->comienzo;
        $promocion->fechaTermina=$request->final;
        $promocion->idEmpresa=Auth::user()->idEmpresa;
        $promocion->visible=1;
        $promocion->save();
        return redirect('admin/promocion');
    }

    public function update(Request $request)
    {
        $promocion=Promocion::findOrFail($request->id);
        $promocion->nombre=$request->nombre;
        $promocion->fechaEmpieza=$request->comienzo;
        $promocion->fechaTermina=$request->final;
        $promocion->update();
        return redirect('admin/promocion');
    }

    public function destroy($id)
    {
        $promocion=Promocion::findOrFail($id);
        $promocion->visible=0;
        $promocion->update();
        return redirect('admin/promocion');
    }



}
