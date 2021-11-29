<?php
session_start();
require("../config/conexion.php");

$name = $_POST["Nombre"];
$rut = $_POST["Rut"];
$age = $_POST["Edad"];
$gender = $_POST["Sexo"];
$adress = $_POST["Direccion"];
$comunens = $_POST["Comuna"];
$ingresado = FALSE;

$query0 = "SELECT usuarios.rut FROM usuarios;";
$result0 = $db2 -> prepare($query0);
$result0 -> execute();
$data0 = $result0 -> fetchAll();
foreach ($data0 as $d) {
    if ($d[0] == $rut) {
        $ingresado = TRUE;
        $_SESSION['register'] = "ya_ingresado";
        break;
     }         
} 

if($ingresado == FALSE AND ($name == "" OR $rut == "" OR $age == "" OR $gender == "" OR $adress == "" OR $comunens == "")){
    $_SESSION['register'] = "vacio";
    $_SESSION['reg_status'] = "done";
    header("Location: register.php");
    } 


if($ingresado == FALSE AND ($name != "" AND $rut != "" AND $age != "" AND $gender != "" AND $adress != "" AND $comunens != "")){
    settype($age, "integer");
    $query = "SELECT registrar_usuarios('$name', '$rut', $age, '$gender', '$adress', '$comunens');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $_SESSION['register'] = "joya";
    $_SESSION['reg_status'] = "done";
    header("Location: register.php");
    } 
else {
    $_SESSION['reg_status'] = "done";
    header("Location: register.php");
}

?>