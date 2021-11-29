<?php session_start();?>

<?php include('../templates/header.html');   ?>
<?php 
        if ($_SESSION['rut'] == '') {
            header("Location: ../index.php");
        }
        ?>
    <body>
        <div class=container>
        <div class=box>
        <h3 align="center">Bienvenido <?php  echo $_SESSION['nombre'] ?></h3>
        </div>
        </div>
        <br>

        <div class=container>
        <div class=box>
        <form align="center" action="perfil.php" method="post">
        <input class="button" type="submit" value="Mi Perfil">
        </form>
        </div>
        <br>

        <div class=box>
        <form align="center" action="compras.php" method="post">
        <input class="button" type="submit" value="Comprar">
        </form>
        </div>
        <br>

        <div class=box>
        <form align="center" action="../index.php" method="post">
        <input class="button" type="submit" value="Cerrar Sesión">
        </form>
        </div>
        </div>
        <br>

    </body>
</html>