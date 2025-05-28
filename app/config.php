<?php
/**
 
 */
define('SERVIDOR','mysql-hermanosfrios2024.alwaysdata.net');
define('USUARIO','372285');
define('PASSWORD','preciado1997*');
define('BD','hermanosfrios2024_sistemadeventas');

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo = new PDO($servidor,USUARIO,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    //echo "La conexión a la base de datos fue con exito";
}catch (PDOException $e){
    //print_r($e);
    echo "Error al conectar a la base de datos";
}

//$URL = "http://localhost/www.sistemadeventas.com";
$URL = "https://hermanosfrios2024.alwaysdata.net";


// SMTP (correo)
define('SMTP_HOST', 'smtp-hermanosfrios.alwaysdata.net');
define('SMTP_PORT', 587);
define('SMTP_USER', 'hermanosfrios@alwaysdata.net');
define('SMTP_PASS', 'Hermanosfrios97**');
define('SMTP_FROM_NAME', 'Departamento de Sistemas');


date_default_timezone_set("America/Guayaquil");
$fechaHora = date('Y-m-d H:i:s');


