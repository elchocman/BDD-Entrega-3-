<?php
session_start();
require("../config/conexion.php");

$product = $_POST["product"];
$tienda_id = $_SESSION["tienda_id"];
$_SESSION["tienda_show"] = TRUE;

$query = "SELECT DISTINCT productos.id,productos.nombre,productos.descripcion,productos.tipo,productos.precio FROM productos,productos_en_tienda WHERE productos_en_tienda.producto_id=productos.id AND productos_en_tienda.tienda_id= $tienda_id AND productos.nombre LIKE '%$product%' ORDER BY productos.id;";
$tienda_id2 = strval($tienda_id);
$result = $db2 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();
$_SESSION["table_product"]=$data;
header("Location: navegacion.php?id=$tienda_id2");
?>