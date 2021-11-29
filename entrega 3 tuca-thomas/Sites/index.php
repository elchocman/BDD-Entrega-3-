<?php session_start(); ?>
<?php 
        if ($_SESSION['status'] == 'valid') {
            $_SESSION['rut'] = '';
        }
        ?>
<?php include('templates/header.html');   ?>
    <body>
        <div class=container>
        <div class=box>
        <img src="images/amazon.png" alt="logo" class="center">
        </div>
        </div>
        <br>

        <div class=container>
        <div class=box>
        <h3 align="center"> Login</h3>
        <form align="center" action="consultas/log_action.php" method="post">
        Rut:<br><input type="text" name="Rut" required='required'><br>
        Clave:<br><input type="text" name="Clave" required='required'><br>
        <?php 
        if ($_SESSION['status'] == 'invalid') {?>
            <p align="center">Datos erroneos</p>
            <?php
        }
        ?>
        <br><input class="button" type="submit" value="Ingresar">
        </form>
        </div>
        <br>

        

        <div class=box>
        <h3 align="center"> No tienes cuenta bro?</h3>
        <form align="center" action="consultas/register.php" method="post">
        <input class="button" type="submit" value="Registrarse">
        </form>
        </div>
        </div>

    </body>
</html>