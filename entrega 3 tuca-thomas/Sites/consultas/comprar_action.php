<?php
session_start();
require("../config/conexion.php");
$product_id = $_POST["product_id"];
$cantidad = $_POST["cantidad"];

if (empty($_SESSION["cart"])){
    $direccion_id = $_POST["direccion"];
    $_SESSION["direccion_id"] = $direccion_id;

}
$tienda_id = $_SESSION["tienda_id"];
$direccion_id = $_SESSION["direccion_id"];


#verificar si la tienda vende el producto
$query = "SELECT productos_en_tienda.producto_id,productos.nombre,productos.precio FROM productos_en_tienda, productos WHERE productos_en_tienda.tienda_id=$tienda_id AND productos.id=productos_en_tienda.producto_id;";
$tienda_id2 = strval($tienda_id);
$result = $db2 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();
$producto_en_tienda = FALSE;

foreach ($data as $d) {
    if ($d[0] == $product_id) {
        $producto_en_tienda = TRUE;
        $producto = $d;
        array_push($producto, $cantidad);
        break;
    }
}

#verificar cobertura
$query2 = "SELECT despacho.comuna_de_cobertura FROM despacho WHERE despacho.tienda_id=$tienda_id;";
$result2 = $db2 -> prepare($query2);
$result2 -> execute();
$data2 = $result2 -> fetchAll();

$query3 = "SELECT direcciones.comuna FROM direcciones WHERE direcciones.id=$direccion_id;";
$result3 = $db2 -> prepare($query3);
$result3 -> execute();
$data3 = $result3 -> fetchAll();
$hay_cobertura = FALSE;

foreach ($data2 as $d2) {
    foreach ($data3 as $d3) {
        if ($d2[0] == $d3[0]) {
            $hay_cobertura = TRUE;
            break;
        }
    }
}

#generar compra
if ($producto_en_tienda == TRUE AND $hay_cobertura == TRUE) {
    array_push($_SESSION['cart'], $producto);
    $_SESSION["compra_result"] = "ok";
}
elseif ($producto_en_tienda == FALSE) {
    $_SESSION["compra_result"] = "no_hay";
}
elseif ($hay_cobertura == FALSE) {
    $_SESSION["compra_result"] = "no_cobertura";
}

$_SESSION["compra_hecha"] = TRUE;
header("Location: navegacion.php?id=$tienda_id2");
?>