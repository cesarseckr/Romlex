<?php  session_start();
  include('../../includes/conexion.php');
  
  ini_set('date.timezone', 'America/Mexico_City');
  
  $id_presupuesto = $_POST['id_presupuesto'];
  $sql="SELECT * FROM proyectos where id_presupuesto='$id_presupuesto'";
  $sq = $db->query($sql);
  $rows= $sq->fetchAll(); 
  $total_dias_proyecto=0;
  foreach ($rows as $row) {
    
    $fecha_inicio=new DateTime($row["fecha_inicio"]);
    $fecha_fin=new DateTime($row["fecha_fin"]);
    $suma_dias=$fecha_fin->diff($fecha_inicio);
    $total_dias_proyecto=$total_dias_proyecto+$suma_dias->days;    
  }

  echo ($total_dias_proyecto);
?>