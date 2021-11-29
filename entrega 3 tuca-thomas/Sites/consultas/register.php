<?php session_start(); ?>
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
        <h3 align="center">Rellene sus datos:</h3>
        <form align="center" action="register_action.php" method="post">
        Nombre:<br><input type="text" name="Nombre" required='required'><br>
        Rut:<br><input type="text" name="Rut" required='required'><br>
        Edad:<br><input type="text" name="Edad" required='required'><br>
        Sexo:<br><select name="Sexo"><option value="hombre">Masculino</option><option value="mujer">Femenino</option></select><br>
        Dirección:<br><input type="text" name="Direccion" required='required'><br>
        Comuna:<br><input type="text" name="Comuna" required='required'><br>
        <?php 
        if ($_SESSION['reg_status'] == 'done') {
            if ($_SESSION['register'] == 'ya_ingresado') {?>
                <p align="center">Ya estas registrado tata</p>
                <?php
            }
            elseif ($_SESSION['register'] == 'joya') {?>
                <p align="center">Registrado correctamente, su contraseña son los 4 primeros dígitos de su RUT</p>
                <?php 
            }
            elseif ($_SESSION['register'] == 'vacio') {?>
                <p align="center">Por favor rellena todos los campos</p>
                <?php 
            }
            session_destroy();
        }
        ?>
        <br><input class="button" type="submit" value="Registrarse">
        </form>
        </div>
        </div>
        <br>

        <div class=container>
        <div class=box>
        <form align="center" action="../index.php" method="post">
        <input class="button" type="submit" value="Volver">
        </form>
        </div>
        </div>
        <br>

    </body>
</html>