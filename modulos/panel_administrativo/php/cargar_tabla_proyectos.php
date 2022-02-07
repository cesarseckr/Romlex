<?php  session_start();
  include('../../includes/conexion.php');
  
  $id_presupuesto = $_POST['id_presupuesto'];
  $sql="SELECT * FROM proyectos where id_presupuesto='$id_presupuesto'";
  $sq = $db->query($sql);
  $rows= $sq->fetchAll(); 
  $total_proyecto=0;
  foreach ($rows as $row) {
    $id_proyecto=$row["id_proyecto"];
    $id_presupuesto=$row["id_presupuesto"];
    $cantidad=$row["cantidad"];
    $desc_producto=$row["desc_producto"];
    $estatus=$row["mat_med"];
    $fecha_alta=$row["fecha_alta"];
    $fecha_inicio=$row["fecha_inicio"];
    $fecha_fin=$row["fecha_fin"];
    $observaciones=$row["observaciones"];
    $material=$row["material"];
    $color_acabado=$row["color_acabado"];
    $total=$row["total"];
    $suma_total=$cantidad*$total;

    $eliminar_proyecto='<button type="button" class="btn btn-danger" id="del_proyecto" id_proyecto="'.$id_proyecto.'"
    ><i class="fas fa-minus-circle"></i> Eliminar</button>';

    $sql_calculos="SELECT * FROM calc_total where id_proyecto='$id_proyecto'";
    $sq_calculos=$db->query($sql_calculos);
    $rows_calculos=$sq_calculos->fetchAll();
    foreach ($rows_calculos as $row_calculos) {
      $id_calc_total=$row_calculos['id_calc_total'];
      $costo_requerido=$row_calculos['costo_requerido'];
      $porc_herramienta=$row_calculos['porc_herramienta'];
      $total_porc_herramienta=$row_calculos['total_porc_herramienta'];
      $horas_trabajo=$row_calculos['horas_trabajo'];
      $total_horas_trabajo=$row_calculos['total_horas_trabajo'];
      $porc_utilidad=$row_calculos['porc_utilidad'];
      $total_porc_utilidad=$row_calculos['total_porc_utilidad'];
      $sub_total=$row_calculos['sub_total'];
      $iva=$row_calculos['iva'];
      $total_iva=$row_calculos['total_iva'];
    }

    $modificar_proyecto='<button class="btn btn-warning" id="mdl_mod_proyecto" 
      id_proyecto="'.$id_proyecto.'"
      id_presupuesto="'.$id_presupuesto.'"
      cantidad="'.$cantidad.'"
      desc_producto="'.$desc_producto.'"
      estatus="'.$estatus.'"
      fecha_alta="'.$fecha_alta.'"
      fecha_inicio="'.$fecha_inicio.'"
      fecha_fin="'.$fecha_fin.'"
      observaciones="'.$observaciones.'"
      material="'.$material.'"
      color_acabado="'.$color_acabado.'"
      id_calc_total="'.$id_calc_total.'"
      costo_requerido="'.$costo_requerido.'"
      porc_herramienta="'.$porc_herramienta.'"
      total_porc_herramienta="'.$total_porc_herramienta.'"
      horas_trabajo="'.$horas_trabajo.'"
      total_horas_trabajo="'.$total_horas_trabajo.'"
      porc_utilidad="'.$porc_utilidad.'"
      total_porc_utilidad="'.$total_porc_utilidad.'"
      sub_total="'.$sub_total.'"
      iva="'.$iva.'"
      total_iva="'.$total_iva.'"
      total="'.$total.'"
    ><i class="fas fa-edit"></i> Modificar</button>';

    echo"
      <tr>
        <td>".$cantidad."</th>
        <td>".$desc_producto."</th>
        <td>".$total."</th>
        <td>".$suma_total."</th>
        <td>".$eliminar_proyecto."</th>
        <td>".$modificar_proyecto."</th>
    </tr>";
  }
?>