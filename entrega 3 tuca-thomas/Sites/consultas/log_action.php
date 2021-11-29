<?php
session_start();
require("../config/conexion.php");

$rut = $_POST["Rut"];
$pass = $_POST["Clave"];

$query = "SELECT usuarios.rut, usuarios.contraseña, usuarios.nombre, usuarios.id FROM usuarios WHERE usuarios.rut='$rut';";
$result = $db2 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();

if($data[0][1] == $pass AND $pass != ""){
    $_SESSION['status'] = 'valid';
    $_SESSION['rut'] = $rut;
    $_SESSION['nombre'] = $data[0][2];
    $_SESSION['id_user'] = $data[0][3];
    header("Location: session.php");
} 
else {
    header("Location: ../index.php");
    $_SESSION['status'] = 'invalid';
}
?>