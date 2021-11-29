<?php session_start();
  $ons = $_SESSION['rut'];
?>
<?php include('../templates/header.html');   ?>

<body>

<?php 
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
 	$query = "SELECT usuarios.nombre, usuarios.rut, usuarios.edad, direcciones.nombre FROM usuarios, direcciones, direccion_usuarios WHERE usuarios.rut = '$ons' AND usuarios.id=direccion_usuarios.usuario_id AND direcciones.id=direccion_usuarios.direccion_id;";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();
  ?>

<div class=container>
  <div class=box>
  <h3 align="center">Información Personal</h3>
  </div>
  </div>
  <br>

  <div class=container>
  <div class=box>
	<table class="table is-bordered is-centered" align="center">
    <tr>
      <th>Nombre</th>
      <th>Rut</th>
      <th>Edad</th>
      <th>Dirección</th>
    </tr>
  <?php
	foreach ($data as $d) {
  		echo "<tr> <td>$d[0]</td> <td>$d[1]</td> <td>$d[2]</td> <td>$d[3]</td> </tr>";
	}
  ?>
	</table>
  </div>
  </div>
  <br>

  <div class=container>
        <div class=box>
        <form align="center" action="perfil.php" method="post">
        <input class="button" type="submit" value="Volver">
        </form>
        </div>
        </div>
