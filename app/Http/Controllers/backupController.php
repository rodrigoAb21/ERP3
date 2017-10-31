<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\backupTable;
use App\Requests\backupRequest;
use DB;

class backupController extends Controller
{
    public function index()
    {
        return view('backup.index');
    }






    public function backup()
    {

        // $db_host = '127.0.0.1'; //dominio donde esta mi BD
        // $db_name = 'proyectosi';
        // $db_user = 'root';
        // $db_pass = 'windows1993';

        // $fecha = date("Tmd-His");



        $db_host   = "sistemaspractica-mysqldbserver.mysql.database.azure.com";
        $db_user      = "JhordanF1@sistemaspractica-mysqldbserver";
        $db_pass      = "Sistemas2";
        $db_name = "sistemas2";
        $fecha   = date("Ymd");


        $salida_sql = $db_name.'_'.$fecha.time().'.sql';

        $backupSave = new backupTable();
        $backupSave->nombre = $salida_sql;
        $backupSave->save();
        //  mysqldump --add-drop-database --databases -hhost -uusuario -ppassword basededatos > basededatos.sql

        $dump = "mysqldump --add-drop-database --databases -h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";

        system($dump, $output);

        //    $zip = new ZipArchive();

        //    $salida_zip = $db_name.'_'.$fecha.'.zip';

        //     if ($zip->open($salida_zip, ZIPARCHIVE::CREATE) == true)
        //     {
        //         $zip->addFile($salida_sql);
        //         $zip->close();
        //         unlink($salida_sql); // elimina el archivo salida_sql


        header("Content-disposition: attachment; filename= $salida_sql");
        header("Content-type: application/sql");
        readfile("$salida_sql");
        //   //  header("Location: $salida_sql"); //hace que luego de convertirlo en zip me lo descargue
        // } else {
        // echo 'Error';
        // }
        return view('backup.index');
    }

    public function show()
    {
        if(Input::hasFile('uploadedfile')){
            $file=Input::file('uploadedfile');
            $file->move('../public/',$file->getClientOriginalName());
            echo $file->getClientOriginalName();  //$file->move(direccionDondeVoyAGuardarElArchivoEnMiServidor,NombreDelArchivoAGuardar)
            $variable->imagen=$file->getClientOriginalName();
        }
    }


    public function restore()
    {

    }

    public function restaurar()
    {
        //     $db_host   = "sistemaspractica-mysqldbserver.mysql.database.azure.com";
        //     $db_user      = "JhordanF1@sistemaspractica-mysqldbserver";
        //     $db_pass      = "Sistemas2";
        //     $db_name = "sistemas2";
        //     $fecha   = date("Ymd");

        //     $fichero_sql;
        //     if(Input::hasFile('archivo')){
        //         $file=Input::file('archivo');
        //         $file->move(public_path().'../public/',$file->getClientOriginalName());   //$file->move(direccionDondeVoyAGuardarElArchivoEnMiServidor,NombreDelArchivoAGuardar)
        //         $variable->imagen=$file->getClientOriginalName();
        //         $fichero_sql=$file->getClientOriginalName();
        //     }





        //   //  mysqldump --add-drop-database --databases -hhost -uusuario -ppassword basededatos > basededatos.sql
        //   //mysql -u usuario -p basededatos < basededatos.sql
        //     $dump = "mysql -h$db_host -u$db_user -p$db_pass $db_name < $fichero_sql";

        //     system($dump, $output);

        $datos= backupTable::all();


        return view('backup.restaurar',['backups'=>$datos]);
    }

    public function save($id)
    {

        //obtenemos el campo file definido en el formulario

        $datos= backupTable::where('id','=',$id)->firstOrFail();
        $datosN= $datos->nombre;
        set_time_limit(300);

        $db_host   = "sistemaspractica-mysqldbserver.mysql.database.azure.com";
        $db_user      = "JhordanF1@sistemaspractica-mysqldbserver";
        $db_pass      = "Sistemas2";
        $db_name = "sistemas2";
        $fecha   = date("Ymd");

        $fichero_sql;
        //  mysqldump --add-drop-database --databases -hhost -uusuario -ppassword basededatos > basededatos.sql
        //mysql -u usuario -p basededatos < basededatos.sql
        $dump = "mysql -h$db_host -u$db_user -p$db_pass $db_name < $datosN";

        $resultado=system($dump, $output);

        return $resultado; //view('backup.index');//.$output.$dump;
    }
}
