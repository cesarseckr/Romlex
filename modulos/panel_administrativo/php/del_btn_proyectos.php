<?php
  include("../../includes/conexion.php"); 
  require("../../includes/conexioncon.php");

  $id_proyecto = $_POST['id_proyecto'];
  
  $eliminar_calculos = mysqli_query($con,"DELETE FROM calc_total WHERE id_proyecto='$id_proyecto'");

  $eliminar_proyectos = mysqli_query($con,"DELETE FROM proyectos WHERE id_proyecto='$id_proyecto'");

  if (!$eliminar_proyectos){
    echo "error al registrar en la base de datos" . mysql_error();
  }else{
     echo "1";
  }

?>