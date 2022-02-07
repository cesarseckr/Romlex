<?php 
	require("../../includes/conexioncon.php");

    $id_presupuesto = $_POST["id_presupuesto"];
    $id_cliente = $_POST["id_cliente"];

    $consulta = mysqli_query($con,"UPDATE presupuestos SET id_cliente='$id_cliente' WHERE id_presupuesto='$id_presupuesto'");

    if (!$consulta){
  		echo "error al registrar en la base de datos" . mysql_error();
  	}else{
      echo '1';
  	}

?>