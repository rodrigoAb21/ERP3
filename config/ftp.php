<?php
return array(

    /*
	|--------------------------------------------------------------------------
	| Default FTP Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the FTP connections below you wish
	| to use as your default connection for all ftp work.
	|
	*/

    'default' => 'connection1',

    /*
    |--------------------------------------------------------------------------
    | FTP Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the FTP connections setup for your application.
    |
    */

    'connections' => array(
        
        'conexion_azure' => array(
            'host'   => 'waws-prod-sn1-047.ftp.azurewebsites.windows.net',
            'port'  => 21,
            'username' => 'sistemaspractica\JhordanF1',
            'password'   => 'Sistemas',
            'passive'   => false,
        ),
        'connection1' => array(
            'host'   => 'waws-prod-sn1-047.ftp.azurewebsites.windows.net',
            'port'  => 21,
            'username' => 'sistemaspractica\JhordanF1',
            'password'   => 'Sistemas',
            'passive'   => false,
        ),
    ),
);