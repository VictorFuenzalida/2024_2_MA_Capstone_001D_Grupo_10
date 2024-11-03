<?php
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'sistemainventario');

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}catch(PDOException $e){
    echo "Error al conectar a la base de datos: ";
}

$URL = "http://localhost/sistemainventario1";

date_default_timezone_set("America/Santiago");
$fechaHora = date("Y-m-d H:i:s");

