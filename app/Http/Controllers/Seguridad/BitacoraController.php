<?php

namespace App\Http\Controllers\Seguridad;

use App\Bitacora;
use App\Modelos\Seguridad\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BitacoraController extends Controller
{

    public function index()
    {
        $empleados=Empleado::all();
        $bitacoras=Bitacora::paginate(10);;
        return view('admin.Seguridad.bitacora.index',compact('bitacoras','empleados'));
    }
    public function search()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
