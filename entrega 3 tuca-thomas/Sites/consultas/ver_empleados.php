<?php session_start();
  $ons = $_SESSION['rut'];
  $ons2 = $_SESSION['id'];
?>
<?php include('../templates/header.html');   ?>

<body>

<?php 
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
 	$query = "SELECT personal.rut, personal.nombre, personal.sexo, personal.edad, lugares.direccion, personal.clasificación, lugares.comuna 
   FROM personal, unidades, trabaja_en, lugares 
   WHERE unidades.id_jefe=$ons2 AND trabaja_en.personal_id=personal.id AND unidades.id=trabaja_en.uid AND unidades.did=lugares.id 
   ORDER BY personal.nombre;";
	$result = $db -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();
  ?>

  <div class=container>
  <div class=box>
  <h3 align="center">Administrativos</h3>
  <h4 align="center">Dirección: <?php  echo $data[0][4] ?>,  <?php  echo $data[0][6]?></h4>
  </div>
  </div>
  <br>



  <div class=container>
  <div class=box>
	<table class="table is-bordered is-centered" align="center">
    <tr>
      <th>Rut</th>
      <th>Nombre</th>
      <th>Sexo</th>
      <th>Edad</th>
      <th>Cargo</th>
    </tr>
  <?php
	foreach ($data as $d) {?> 
  		<tr> <td><?php echo $d[0]; ?></td> <td><?php echo $d[1]; ?></td> <td><?php echo $d[2]; ?></td> <td><?php echo $d[3]; ?></td> </td> <td><?php echo $d[5]; ?></td></tr>
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
