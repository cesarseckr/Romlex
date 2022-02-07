<?php  session_start();
  include('../../includes/conexion.php');
  
  $id_presupuesto = $_POST['id_presupuesto'];
  $sql="SELECT * FROM proyectos where id_presupuesto='$id_presupuesto'";
  $sq = $db->query($sql);
  $rows= $sq->fetchAll(); 
  $total_proyecto=0;
  foreach ($rows as $row) {
    $id_proyecto=$row["id_proyecto"];
    $cantidad=$row["cantidad"];
    $total=$row["total"];
    $suma_total=$cantidad*$total;
    $total_proyecto=$total_proyecto+$suma_total;
  }

  echo $total_proyecto;
?>