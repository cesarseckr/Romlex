<?php
  include("../../includes/conexion.php"); 
  require("../../includes/conexioncon.php");

  $id_presupuesto = $_POST['id_presupuesto'];

  $sql_id_proyecto="SELECT * FROM proyectos where id_presupuesto='$id_presupuesto'";
  $sq_id_proyecto=$db->query($sql_id_proyecto);
  $rows= $sq_id_proyecto->fetchAll(); 
  foreach ($rows as $row) {
    $id_proyecto=$row['id_proyecto'];
    $eliminar_calculos = mysqli_query($con,"DELETE FROM calc_total WHERE id_proyecto='$id_proyecto'");
  }

  $eliminar_proyectos = mysqli_query($con,"DELETE FROM proyectos WHERE id_presupuesto='$id_presupuesto'");
  $eliminar_presupuestos = mysqli_query($con,"DELETE FROM presupuestos WHERE id_presupuesto='$id_presupuesto'");

  if (!$eliminar_proyectos AND !$eliminar_presupuestos){
    echo "error al registrar en la base de datos" . mysql_error();
  }else{
     echo "1";
  }

?>