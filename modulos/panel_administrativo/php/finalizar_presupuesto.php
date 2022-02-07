<?php 
	require("../../includes/conexioncon.php");
  ini_set('date.timezone', 'America/Mexico_City');

  $id_presupuesto = $_POST["id_presupuesto"];
  $id_cliente=$_POST["id_cliente"];
  $tiempo_desarrollo = $_POST["tiempo_desarrollo"];
  $requerimientos = $_POST["requerimientos"];
  $consideracion = $_POST["consideracion"];
  $fecha_presupuesto = date('Y-m-d', time());
  $total_presupuesto = $_POST["total_presupuesto"];
    
  $consulta = mysqli_query($con,"UPDATE presupuestos SET id_cliente='$id_cliente', tiempo_desarrollo='$tiempo_desarrollo', requerimientos='$requerimientos', consideraciones='$consideracion', fecha_presupuesto='$fecha_presupuesto', total_presupuesto='$total_presupuesto' WHERE id_presupuesto='$id_presupuesto'");

  if (!$consulta){
	 echo "error al registrar en la base de datos" . mysql_error();
	}else{
	 echo"1";
	}
?>