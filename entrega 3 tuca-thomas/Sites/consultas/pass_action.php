<?php
session_start();
$ons = $_SESSION['rut'];
require("../config/conexion.php");

$old = $_POST["old"];
$new = $_POST["new"];

$query = "SELECT usuarios.rut, usuarios.contraseña FROM usuarios WHERE usuarios.rut='$ons';";
$result = $db2 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();
if($data[0][1] == $old){
    $query = "SELECT cambiar_contraseña('$ons', '$new');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    header("Location: perfil.php");
} else {
    header("Location: cambiar_pass.php");
}
?>