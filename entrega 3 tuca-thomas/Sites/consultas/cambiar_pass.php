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
        <form align="center" action="pass_action.php" method="post">
        Contraseña actual:<br><input type="text" name="old" required='required'><br>
        Nueva Contraseña:<br><input type="text" name="new" required='required'><br>
        <br><input class="button" type="submit" value="Cambiar Clave">
        </form>
        </div>
        <br>

        <div class=box>
        <form align="center" action="perfil.php" method="post">
        <input class="button" type="submit" value="Volver">
        </form>
        </div>
        </div>

    </body>
</html>