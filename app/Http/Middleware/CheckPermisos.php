<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$cu,$accion)
    {

        if(!$this->checkPermiso($cu, $accion))
        {
            $request->session()->flash('mensaje', 'Usted no tiene permisos para '.$accion.' los registros de esta seccion');
            return redirect('/admin/mensaje');
        }

        return $next($request);
    }

    /**
     * @param $cu
     * @param $accion
     * @return bool
     */
    private function checkPermiso($cu, $accion)
    {
        $cus = Auth::user()->empleado->rol->casousos;
        foreach ($cus as $cu1) {
            if ($cu1->id == $cu) {
                switch ($accion) {
                    case 'leer':
                        if ($cu1->pivot->leer == 1)
                            return true;
                        break;
                    case 'crear':
                        if ($cu1->pivot->crear == 1)
                            return true;
                        break;
                    case 'editar':
                        if ($cu1->pivot->editar == 1)
                            return true;
                        break;
                    case 'eliminar':
                        if ($cu1->pivot->eliminar == 1)
                            return true;
                        break;
                }
                return false;
            }
        }
        return false;
    }
}
