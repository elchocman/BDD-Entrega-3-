<?php session_start();
  $ons = $_SESSION['rut'];
  $id = $_GET['id'];
?>
<?php include('../templates/header.html');   ?>

<body>

<?php 
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
 	$query = "SELECT DISTINCT productos.id, productos.nombre, productos_en_compra.cantidad, (productos_en_compra.cantidad * productos.precio) as Subtotal FROM compras, productos, productos_en_compra, usuarios WHERE compras.usuario_id=usuarios.id AND productos.id=productos_en_compra.producto_id AND compras.id=productos_en_compra.compra_id AND compras.id=$id AND usuarios.rut = '$ons';";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();
  ?>

  <div class=container>
  <div class=box>
  <h3 align="center">Detalles de Compra: <?php echo $id ?> </h3>
  </div>
  </div>
  <br>

  <div class=container>
  <div class=box>
	<table class="table is-bordered is-centered" align="center">
    <tr>
      <th>ID</th>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Subtotal</th>
    </tr>
  <?php
  $total = 0;
	foreach ($data as $d) {
      $total += $d[3];
  		echo "<tr> <td>$d[0]</td> <td>$d[1]</td> <td>$d[2]</td> <td>$d[3]</td> </tr>";
	}
  ?>
	</table>
  <h3 align="center">Total: <?php echo $total; ?> </h3>
  </div>
  </div>
  <br>

  <div class=container>
  <div class=box>
        <form align="center" action="historial_de_compras.php" method="post">
        <input class="button" type="submit" value="Volver">
        </form>
        </div>
        </div>
        <br>

