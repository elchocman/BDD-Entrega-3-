<?php session_start();
  $ons = $_SESSION['rut'];
?>
<?php include('../templates/header.html');   ?>

<body>

<?php 
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
 	$query = "SELECT DISTINCT compras.id, tiendas.nombre, compras.fecha FROM compras, tiendas, usuarios WHERE compras.tienda_id=tiendas.id AND compras.usuario_id=usuarios.id AND usuarios.rut = '$ons';";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();
  ?>

  <div class=container>
  <div class=box>
  <h3 align="center">Historial de Compras</h3>
  </div>
  </div>
  <br>

  <div class=container>
  <div class=box>
	<table class="table is-bordered is-centered" align="center">
    <tr>
      <th>ID</th>
      <th>Tienda</th>
      <th>Fecha</th>
      <th>Productos</th>
    </tr>
  <?php
	foreach ($data as $d) {
      $id = $d[0] ?> 
  		<tr> <td><?php echo $d[0]; ?></td> <td><?php echo $d[1]; ?></td> <td><?php echo $d[2]; ?></td> <td><a href="productos.php?id= <?php echo $d[0]; ?>">Ver Productos</a></td> </tr>
      <?php
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
        <br>
