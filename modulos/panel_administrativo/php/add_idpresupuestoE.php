<?php 
	require("../../includes/conexioncon.php");

	  
    ini_set('date.timezone', 'America/Mexico_City');
    $fecha_presupuesto= date('Y-m-d', time());

    $consulta = mysqli_query($con,"INSERT INTO presupuestos (fecha_presupuesto) VALUES ('$fecha_presupuesto')");

    if (!$consulta){
  		echo "error al registrar en la base de datos" . mysql_error();
  	}else{
      require("../../includes/conexion.php");
      $recuperar="SELECT MAX(id_presupuesto) as id_presupuesto FROM presupuestos";
      $sq= $db->query($recuperar);
      $rows=$sq->fetchAll();
      foreach ($rows as $row) {
        $id_presupuesto=$row["id_presupuesto"];  
      }
      echo $id_presupuesto;
  	}

 ?>