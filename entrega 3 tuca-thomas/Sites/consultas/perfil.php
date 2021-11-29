<?php session_start();
$ons = $_SESSION['rut'];
$es_jefe = FALSE;
?>

<?php 
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        require("../config/conexion.php");
            $query2 = "SELECT personal.id,personal.rut FROM personal, unidades WHERE unidades.id_jefe=personal.id AND personal.clasificación='administracion'";
            $result2 = $db -> prepare($query2);
            $result2 -> execute();
            $data2 = $result2 -> fetchAll();
        ?>

<?php include('../templates/header.html');   ?>
    <body>
        <div class=container>
        <div class=box>
        <img src="../images/amazon.png" alt="logo" class="center">
        </div>
        </div>
        <br>

        <div class=container>
        <div class=box>
        <form align="center" action="informacion.php" method="post">
        <input class="button" type="submit" value="Información Personal">
        </form>
        </div>
        <br>


        <div class=box>
        <form align="center" action="historial_de_compras.php" method="post">
        <input class="button" type="submit" value="Historial de Compras">
        </form>
        </div>
        <br> 


        <?php
            foreach ($data2 as $d) {
            $rut = $d[1] ;
                if ($rut == $ons){
                    $es_jefe = TRUE;
                    $_SESSION['id'] = $d[0];
                    break;}

            };
            if ($es_jefe==TRUE){?>
                <div class=box>
                <form align="center" action="ver_empleados.php" method="post">
                <input class="button" type="submit" value="Ver empleados">
                </form>
                </div>
                <br> <?php
            }
            

        ?>

        <div class=box>
        <form align="center" action="cambiar_pass.php" method="post">
        <input class="button" type="submit" value="Cambiar Contraseña">
        </form>
        </div>
        <br>

        <div class=box>
        <form align="center" action="session.php" method="post">
        <input class="button" type="submit" value="Volver">
        </form>
        </div>
        </div>

    </body>
</html>