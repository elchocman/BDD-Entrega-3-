<?php session_start();
  $ons = $_SESSION['rut'];
  $id_product = $_GET['id'];
?>
<?php include('../templates/header.html');   ?>

<body>

<?php 
  #sacar tipo de producto
  require("../config/conexion.php");
 	$query = "SELECT DISTINCT tipo FROM productos WHERE id=$id_product";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();
  $producto_tipo = $data[0][0]
  ?>

  <div class=container>
  <div class=box>
  <h3 align="center">Información del producto: <?php echo $id_product ?> </h3>
  </div>
  </div>
  <br>

  <?php
  #No comestibles
  if ($producto_tipo == "no_comestible") {

    $query2 = "SELECT productos.id,productos.nombre,productos.precio,productos.descripcion,productos.tipo,productos_no_comestibles.largo,productos_no_comestibles.alto,productos_no_comestibles.ancho,productos_no_comestibles.peso FROM productos, productos_no_comestibles WHERE productos.id = productos_no_comestibles.producto_id AND productos.id=$id_product;";
    $result2 = $db2 -> prepare($query2);
    $result2 -> execute();
    $data2 = $result2 -> fetchAll();

    ?>
    <div class=container>
    <div class=box>
	  <table class="table is-bordered is-centered" align="center">
    <tr><th>ID</th><td> <?php echo $data2[0][0]; ?> </td></tr>
    <tr><th>Nombre</th><td> <?php echo $data2[0][1]; ?> </td></tr>
    <tr><th>Precio</th><td> <?php echo $data2[0][2]; ?> </td></tr>
    <tr><th>Descripción</th><td> <?php echo $data2[0][3]; ?> </td></tr>
    <tr><th>Clasificación</th><td> No comestible </td></tr>
    <tr><th>Largo</th><td> <?php echo $data2[0][5]; ?> </td></tr>
    <tr><th>Alto</th><td> <?php echo $data2[0][6]; ?> </td></tr>
    <tr><th>Ancho</th><td> <?php echo $data2[0][7]; ?> </td></tr>
    <tr><th>Peso</th><td> <?php echo $data2[0][8]; ?> </td></tr>

    </tr>
	  </table>
    </div>
    </div>
    <br>
    <?php
  }

  #Conservas
  elseif ($producto_tipo == "comestibles_conserva") {

    $query2 = "SELECT productos.id,productos.nombre,productos.precio,productos.descripcion,productos.tipo, productos_conserva.fecha_caducidad, productos_conserva.tipo_de_conserva FROM productos, productos_conserva WHERE productos.id =  productos_conserva.producto_id AND productos.id=$id_product;";
    $result2 = $db2 -> prepare($query2);
    $result2 -> execute();
    $data2 = $result2 -> fetchAll();

    ?>
    <div class=container>
    <div class=box>
	  <table class="table is-bordered is-centered" align="center">
    <tr><th>ID</th><td> <?php echo $data2[0][0]; ?> </td></tr>
    <tr><th>Nombre</th><td> <?php echo $data2[0][1]; ?> </td></tr>
    <tr><th>Precio</th><td> <?php echo $data2[0][2]; ?> </td></tr>
    <tr><th>Descripción</th><td> <?php echo $data2[0][3]; ?> </td></tr>
    <tr><th>Clasificación</th><td> Conserva </td></tr>
    <tr><th>Vencimiento</th><td> <?php echo $data2[0][5]; ?> </td></tr>
    <tr><th>Tipo</th><td> <?php echo $data2[0][6]; ?> </td></tr>

    </tr>
	  </table>
    </div>
    </div>
    <br>
    <?php
  }

  #Congelados
  elseif ($producto_tipo == "comestibles_congelados") {

    $query2 = "SELECT productos.id,productos.nombre,productos.precio,productos.descripcion,productos.tipo,productos_congelados.peso,productos_congelados.fecha_caducidad FROM productos, productos_congelados WHERE productos.id = productos_congelados.producto_id AND productos.id=$id_product;";
    $result2 = $db2 -> prepare($query2);
    $result2 -> execute();
    $data2 = $result2 -> fetchAll();

    ?>
    <div class=container>
    <div class=box>
	  <table class="table is-bordered is-centered" align="center">
    <tr><th>ID</th><td> <?php echo $data2[0][0]; ?> </td></tr>
    <tr><th>Nombre</th><td> <?php echo $data2[0][1]; ?> </td></tr>
    <tr><th>Precio</th><td> <?php echo $data2[0][2]; ?> </td></tr>
    <tr><th>Descripción</th><td> <?php echo $data2[0][3]; ?> </td></tr>
    <tr><th>Clasificación</th><td> Congelado </td></tr>
    <tr><th>Vencimiento</th><td> <?php echo $data2[0][6]; ?> </td></tr>
    <tr><th>Peso</th><td> <?php echo $data2[0][5]; ?> </td></tr>

    </tr>
	  </table>
    </div>
    </div>
    <br>
    <?php
  }

  #Frescos
  elseif ($producto_tipo == "comestibles_frescos") {

    $query2 = "SELECT productos.id,productos.nombre,productos.precio,productos.descripcion,productos.tipo, productos_frescos.fecha_caducidad, productos_frescos.duracion_sin_refrigerar FROM productos, productos_frescos WHERE productos.id=productos_frescos.producto_id AND productos.id=$id_product;";
    $result2 = $db2 -> prepare($query2);
    $result2 -> execute();
    $data2 = $result2 -> fetchAll();

    ?>
    <div class=container>
    <div class=box>
	  <table class="table is-bordered is-centered" align="center">
    <tr><th>ID</th><td> <?php echo $data2[0][0]; ?> </td></tr>
    <tr><th>Nombre</th><td> <?php echo $data2[0][1]; ?> </td></tr>
    <tr><th>Precio</th><td> <?php echo $data2[0][2]; ?> </td></tr>
    <tr><th>Descripción</th><td> <?php echo $data2[0][3]; ?> </td></tr>
    <tr><th>Clasificación</th><td> Fresco </td></tr>
    <tr><th>Vencimiento</th><td> <?php echo $data2[0][5]; ?> </td></tr>
    <tr><th>Duración</th><td> <?php echo $data2[0][6]; ?> </td></tr>

    </tr>
	  </table>
    </div>
    </div>
    <br>
    <?php
  }

  $tienda_id = $_SESSION["tienda_id"];
  $tienda_id2 = strval($tienda_id);
  ?>

  <div class=container>
  <div class=box>
        <form align="center" action="navegacion.php?id= <?php echo $tienda_id2; ?>" method="post">
        <input class="button" type="submit" value="Volver">
        </form>
        </div>
        </div>
        <br>
