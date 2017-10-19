
<?php

// $du="mysqldump --version";
// $arr_out = array();
// $message=exec($du,$arr_out, $return);
// echo $message;
//define("BACKUP_PATH", "../site/wwwroot/");

$server_name   = "sistemaspractica-mysqldbserver.mysql.database.azure.com";
$username      = "JhordanF1@sistemaspractica-mysqldbserver";
$password      = "Sistemas2";
$database_name = "sistemas2";
$date_string   = date("Ymd");

// $server_name   = "173.199.127.236";
// $username      = "u1494";
// $password      = "mt1vqxka9";
// $database_name = "si2uagrm";
// $date_string   = date("Ymd");

$cmd = "mysqldump --hex-blob --routines --skip-lock-tables --log-error=mysqldump_error.log -h {$server_name} -u {$username} -p{$password} {$database_name} > {$date_string}_{$database_name}.sql";

$arr_out = array();
unset($return);

exec($cmd, $arr_out, $return);

if($return !== 0) {
    echo "mysqldump for {$server_name} : {$database_name} failed with a return code of {$return}\n\n";
    echo "Error message was:\n";
    $file = escapeshellarg("mysqldump_error.log");
    $message = `tail -n 1 $file`;
    echo "- $message\n\n";
}
?>

