<?php
session_start();
require("../config/conexion.php");

$tienda_id = $_SESSION['tienda_id'];
$user_id = $_SESSION['id_user'];
$direccion_id = $_SESSION["direccion_id"] ;
$tienda_id2 = strval($tienda_id);


#FALTA PONER BIEN LA QUERY Y GENERAR ID FINO
$query4 = "SELECT MAX(compras.id)+1 FROM compras;";
$result4 = $db2 -> prepare($query4);
$result4 -> execute();
$data4 = $result4 -> fetchAll();
$maximo = $data4[0][0];

$fechas = getdate();
$fecha = $fechas['year'] . "-" . str_pad($fechas['mon'], 2, "0", STR_PAD_LEFT) . "-" . str_pad($fechas['mday'], 2, "0", STR_PAD_LEFT);


foreach ($_SESSION['cart'] as $d) {
    $query = "SELECT generar_compra($maximo, $d[0], $user_id, $direccion_id,$tienda_id, $d[3], '$fecha');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
}

$_SESSION['checkout']='ok';
$_SESSION['cart'] = array();
header("Location: navegacion.php?id=$tienda_id2");

?>
