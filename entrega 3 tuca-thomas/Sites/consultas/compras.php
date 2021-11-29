<?php session_start();
  $ons = $_SESSION['rut'];
  $_SESSION['tienda_show']=FALSE;
  $_SESSION['compra_hecha']=FALSE;
  $_SESSION["cart"] = array();
  $_SESSION['checkout']='';
?>
<?php include('../templates/header.html');   ?>

<body>

<?php 
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
 	$query = "SELECT DISTINCT tiendas.id, tiendas.nombre, direcciones.nombre, direcciones.comuna FROM tiendas, direcciones WHERE direcciones.id=tiendas.direccion_id ORDER BY tiendas.id;";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();
  ?>

  <div class=container>
  <div class=box>
  <h3 align="center">Tiendas</h3>
  </div>
  </div>
  <br>

  <div class=container>
  <div class=box>
	<table class="table is-bordered is-centered" align="center">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Dirección</th>
      <th>Comuna</th>
      <th>Visitar</th>
    </tr>
  <?php
	foreach ($data as $d) {
      $id = $d[0] ?>
  		<tr> <td><?php echo $d[0]; ?></td> <td><?php echo $d[1]; ?></td> <td><?php echo $d[2]; ?></td> <td><?php echo $d[3]; ?></td> <td><a href="navegacion.php?id= <?php echo $d[0]; ?>">Ver Tienda</a></td> </tr>
      <?php
	}    
  ?>
	</table>
  </div>
  </div>
  <br>

  <div class=container>
  <div class=box>
        <form align="center" action="session.php" method="post">
        <input class="button" type="submit" value="Volver">
        </form>
        </div>
        </div>
        <br>
