<?php 
	require("../../includes/conexioncon.php");

    $id_presupuesto = $_POST["id_presupuesto"];
    $cantidad = $_POST["cantidad"];
    $produc_desc = $_POST["produc_desc"];
    $material = $_POST["material"];
    $color_acabado = $_POST["color_acabado"];
    $observaciones = $_POST["observaciones"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_entrega = $_POST["fecha_entrega"];
    $total = $_POST["total"];
    $costo_requerido = $_POST["costo_requerido"];
    $total_desgaste = $_POST["total_desgaste"];
    $tiempo_req = $_POST["tiempo_req"];
    $total_tiempo_req = $_POST["total_tiempo_req"];
    $porc_utilidad = $_POST["porc_utilidad"];
    $total_utilidad = $_POST["total_utilidad"];
    $subtotal = $_POST["subtotal"];
    $impuesto = $_POST["impuesto"];
    $total_iva = $_POST["total_iva"];


    $consulta = mysqli_query($con,"INSERT INTO proyectos (desc_producto, estatus,fecha_alta, fecha_inicio, fecha_fin, observaciones, material, color_acabado, total, id_presupuesto,cantidad) VALUES ('$produc_desc', '1', '$fecha_inicio', '$fecha_inicio', '$fecha_entrega', '$observaciones', '$material', '$color_acabado', '$total', '$id_presupuesto','$cantidad')");

    if (!$consulta){
  		echo "error al registrar en la base de datos" . mysql_error();
  	}else{
      require("../../includes/conexion.php");
      $recuperar="SELECT MAX(id_proyecto) as id_proyecto FROM proyectos";
      $sq= $db->query($recuperar);
      $rows=$sq->fetchAll();
      foreach ($rows as $row) {
        $id_proyecto=$row["id_proyecto"];
         $consulta_2 = mysqli_query($con,"INSERT INTO calc_total (id_proyecto, costo_requerido, total_porc_herramienta, horas_trabajo, total_horas_trabajo, porc_utilidad, total_porc_utilidad, sub_total, iva, total_iva) VALUES ('$id_proyecto', '$costo_requerido', '$total_desgaste', '$tiempo_req', '$total_tiempo_req', '$porc_utilidad', '$total_utilidad', '$subtotal', '$impuesto','$total_iva')");

        if (!$consulta_2){
          echo "error al registrar en la base de datos" . mysql_error();
        }else{  
          echo '1';
        }  
      }    
  	}

 ?>