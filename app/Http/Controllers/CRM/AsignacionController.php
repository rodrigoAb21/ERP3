<?php

namespace App\Http\Controllers\CRM;

use App\Modelos\CRM\Asignacion;
use App\Modelos\CRM\Estado;
use App\Modelos\CRM\Seguimiento;
use App\Modelos\CRM\Tarea;
use App\Modelos\Ventas\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Seguridad\Bitacora;
use App\Utils;
class AsignacionController extends Controller
{
    public function index($id)
    {
        $seguimiento=Seguimiento::find($id);
        if(!empty($seguimiento))
        {
            $tareas=$this->getAllWhere($seguimiento->id);
             $fechaActual = $this->getFechaActual();
            return view('admin.CRM.asignaciones.index',
                compact('seguimiento','fechaActual'))->with('tareas',json_encode($tareas));
        }
        else{
            flash('No se encontraron registros de tareas...')->error();
            return redirect('admin/seguimientos');
        }
    }

    public function getAllWhere($id)
    {
       return DB::select('select tarea.id as id,tarea.nombre as title,asignacion.fecha as start,estado.color as color
                from asignacion ,tarea,estado
                WHERE asignacion.seguimiento=?
                and asignacion.tarea=tarea.id
                and tarea.estado_id=estado.id', [$id]);
    }
    public function store($id,Request $request)
    {
        if($this->validar($request->fecha) && $this->validarHoras($request->inicio,$request->final)) {
            if($this->guardarTarea($request))
            {
                $this->enviarMensajeSucess();
            }else
            {
                $this->enviarMensajeError();

            }
        }
        else
        {
            $this->enviarMensajeDatosInvalidos();

        }
        return redirect('admin/asignacion/'.$id);
    }

    public function findwhere($tarea,$seguimiento)
    {
        return Asignacion::where('tarea','=', $tarea)
            ->where('seguimiento','=',$seguimiento)
            ->first();
    }
    public function destroy($tarea,$seguimiento)
    {
        $asignacion=$this->findwhere($tarea,$seguimiento);
        $_tarea=Tarea::find($tarea);
        if($asignacion->delete())
        {

            $_tarea->delete();
            $this->enviarMensajeSuccess();
        }
        else
        {
            $this->enviarMensajeErrorDestroy();
        }
        return redirect('admin/asignacion/'.$seguimiento);
    }

    private function validar($fecha)
    {
        $fechaActual = $this->getFechaActual();
       return $fecha>=$fechaActual;
    }
    private function validarHoras($inicio, $final)
    {
        return $inicio<=$final;
    }
    private function guardarTarea(Request $request)
    {
        $estado=Estado::find(1);

        $tarea=new Tarea;
        $tarea->nombre=$request->nombre;
        $tarea->descripcion=$request->descripcion;
        $tarea->estado_id=$estado->id;
        $tarea->color=$estado->color;
        $tarea->visible=1;
        if($tarea->save()){
            $asignacion=new Asignacion;
            $asignacion->fecha=$request->fecha;
            $asignacion->nota=$request->lugar;
            $asignacion->hora_inicio=$request->inicio;
            $asignacion->hora_final=$request->final;
            $asignacion->seguimiento=$request->seguimiento;
            $asignacion->tarea=$tarea->id;

            if($asignacion->save())
            {
                Bitacora::registrarCreate( Utils::$TABLA_TAREA,$tarea->id,'se creo la tarea '.$tarea -> nombre);
                return true;
            }
            else{
                $tarea->delete();
                return false;
            }

        }
        return false;
    }
    public function getFechaActual()
    {
        return $fechaActual = Carbon::now()->format('Y-m-d');
    }

    public function enviarMensajeError()
    {
        flash('Ups ... ocurrio un error al registrar la tarea.')->error();
    }

    public function enviarMensajeSucess()
    {
        flash('Tarea registrada exitosamente...!!')->success();
    }

    public function enviarMensajeDatosInvalidos()
    {
        flash('La fecha y las horas de la tarea son incorrrectas.')->error();
    }

    public function enviarMensajeSuccess()
    {
        flash('La tarea fue eliminada .')->success();
    }

    public function enviarMensajeErrorDestroy()
    {
        flash('Ups hubo un error al eliminar la tarea.')->error();
    }

}
