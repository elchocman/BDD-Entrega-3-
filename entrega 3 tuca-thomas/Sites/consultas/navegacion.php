<?php session_start();
  $ons = $_SESSION['rut'];
  $id = $_GET['id'];
  $_SESSION['tienda_id']=$id;
  $ocultar = TRUE;
?>
<?php include('../templates/header.html');   ?>

<body>

<?php 
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
 	$query_c = "SELECT DISTINCT productos.id, productos.nombre, productos.precio FROM productos, productos_en_tienda, tiendas WHERE tiendas.id=productos_en_tienda.tienda_id AND productos_en_tienda.producto_id=productos.id AND productos.tipo<>'no_comestible' AND tiendas.id = '$id' ORDER BY productos.precio LIMIT 3 ;";
	$result_c = $db2 -> prepare($query_c);
	$result_c -> execute();
	$data_c = $result_c -> fetchAll();

  $query_n = "SELECT DISTINCT productos.id, productos.nombre, productos.precio FROM productos, productos_en_tienda, tiendas WHERE tiendas.id=productos_en_tienda.tienda_id AND productos_en_tienda.producto_id=productos.id AND productos.tipo='no_comestible' AND tiendas.id = '$id' ORDER BY productos.precio LIMIT 3 ;";
	$result_n = $db2 -> prepare($query_n);
	$result_n -> execute();
	$data_n = $result_n -> fetchAll();
  ?>

<?php
  #Primero obtenemos todos los tipos de pokemones
  $result = $db2 -> prepare("SELECT DISTINCT direcciones.id,direcciones.nombre FROM usuarios, direcciones, direccion_usuarios WHERE usuarios.rut='$ons'AND direccion_usuarios.direccion_id=direcciones.id AND usuarios.id=direccion_usuarios.usuario_id;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <div class=container>
  <div class=box>
  <h3 align="center">Tienda: <?php echo $id ?> </h3>
  </div>
  </div>
  <br>

  <div class=container>
  <div class=box>
  <h3 align="center">Mejores precios</h3>
  <button align="center" onclick="myFunction()">Ver Productos</button>
  <div class="flex-container">

  <div class=box2 id="c" style="display:none">
  <h3 align="center">Comestibles </h3>
  <table class="table is-bordered is-centered" align="center">
    <tr>
      <th>ID</th>
      <th>Producto</th>
      <th>Precio</th>
    </tr>
  <?php
	foreach ($data_c as $d) {
  		echo "<tr> <td>$d[0]</td> <td>$d[1]</td> <td>$d[2]</td> </tr>";
	}
  ?>
	</table>
  </div>

  <div class=box2 id="n" style="display:none">
  <h3 align="center">No Comestibles </h3>
  <table class="table is-bordered is-centered" align="center">
    <tr>
      <th>ID</th>
      <th>Producto</th>
      <th>Precio</th>
    </tr>
  <?php
	foreach ($data_n as $d) {
  		echo "<tr> <td>$d[0]</td> <td>$d[1]</td> <td>$d[2]</td> </tr>";
	}
  ?>
	</table>
  </div>

  </div>
  </div>
  </div>
  <br>
  
  <div class=container>
  <div class=box>
  <h3 align="center">Buscar productos: </h3>
  <form align="center" action="navegacion_action.php" method="post">
  Producto:<br><input type="text" name="product"><br>
  <input class="button" type="submit" value="Buscar">
  </form>
  <br>
  <?php
  if ($_SESSION["tienda_show"]==TRUE){?>
  <table class="table is-bordered is-centered" align="center">
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Categoria</th>
      <th>Precio</th>
      <th>Información</th>
    </tr>
  <?php
  foreach ($_SESSION["table_product"] as $a) {

    if ($a[3] == "no_comestible") {
      $categoria = "No comestible";
    }
  
    #Conservas
    elseif ($a[3] == "comestibles_conserva") {
      $categoria = "Conserva";
    }
  
    #Congelados
    elseif ($a[3] == "comestibles_congelados") {
      $categoria = "Congelado";
    }
  
    #Frescos
    elseif ($a[3] == "comestibles_frescos") {
      $categoria = "Fresco";
    }

    ?> 
    <tr> <td><?php echo $a[0]; ?></td> <td><?php echo $a[1]; ?></td> <td><?php echo $a[2]; ?></td> <td><?php echo $categoria; ?></td> </td> <td><?php echo $a[4]; ?></td> <td><a href="info_product.php?id= <?php echo $a[0]; ?>">Ver Productos</a></td> </tr>
    <?php
	}    
  ?>
	</table>
  <?php
  }
  ?>
  <?php $_SESSION["tienda_show"]=FALSE ; ?>
  </div>
  </div>
  <br>


  <div class=container>
  <div class=box>
  <h3 align="center">Comprar productos:</h3>
  <form align="center" action="comprar_action.php" method="post">
  Producto:<br><input type="text" name="product_id" required='required'><br>
  <br>
  Cantidad:<br><input type="number" name="cantidad" min="1" required='required'><br>
  <br>
  <?php
  if(empty($_SESSION["cart"])){?> 
    Escoge tu dirección: <br> <select name="direccion">
    <br>
        <?php
        #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
        foreach ($dataCollected as $d) {
          echo "<option value=$d[0]>$d[1]</option>";
        }
        ?>
      </select>
      <br>
      <?php
   }
   ?> <br> 
  <input class="button" type="submit" value="Agregar al carrito">
  <?php
  if($_SESSION['checkout']=='ok'){?> 
    <h3 align="center">Tu compra se ha realizado con exito!</h3>
    
    <?php  $_SESSION['checkout']='';
            $ocultar = FALSE;
  }?>




  </form>

  <?php 
  if ($_SESSION['compra_hecha'] == TRUE AND $ocultar == TRUE) {
    if ($_SESSION['compra_result'] == 'ok') {?>
      <p align="center">Producto agregado al carrito</p>
      <?php 
    }
    elseif ($_SESSION['compra_result'] == 'no_hay') {?>
      <p align="center">No hay stock del producto solicitado</p>
      <?php 
    }
    elseif ($_SESSION['compra_result'] == 'no_cobertura') {?>
      <p align="center">La tienda no tiene cobertura a tu domicilio</p>
      <?php 
    }
    $_SESSION['compra_hecha'] == FALSE;
  }
  ?>
  <?php
  if(!empty($_SESSION["cart"])){?>
    <table class="table is-bordered is-centered" align="center">
      <tr>
        <th>Id</th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
      </tr>
    <?php
    foreach ($_SESSION["cart"] as $a) {?> 
    <tr> <td><?php echo $a[0]; ?></td> <td><?php echo $a[1]; ?></td> <td><?php echo $a[2]; ?></td> <td><?php echo $a[3]; ?></td> </tr>
    <?php
    $total += $a[2]*$a[3];
    }    
    ?>
    </table>
    <h3 align="center">Total: <?php echo $total; ?> </h3>
    
    <br>

    <form align="center" action="checkout.php" method="post">
    <input class="button" type="submit" value="Comprar">
    </form>
    <?php
    
    
    }
  
  ?>

  <br>




  </div>
  </div>

  <br>

  <div class=container>
  <div class=box>
        <form align="center" action="compras.php" method="post">
        <input class="button" type="submit" value="Volver">
        </form>
        </div>
        </div>
        <br>

<script>
function myFunction() {
  var x = document.getElementById("c");
  var y = document.getElementById("n");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  if (y.style.display === "none") {
    y.style.display = "block";
  } else {
    y.style.display = "none";
  }
}
</script>