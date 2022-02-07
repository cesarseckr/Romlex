<div id="tabla" class="table-responsive" style="padding-bottom: 15px;">
  <br>
  <script>
    $(document).ready(function() {
      tabla("Listado de presupuestos");
    });
  </script>
  <table id="tabla-1" class="display nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="noExport">PDF</th>
        <th class="noExport">Editar</th>
        <th>Fecha de alta</th>
        <th>Cliente</th>
        <th>Total</th>
        <th class="noExport"></th>
      </tr>
    </thead>
    <tbody>
      <? 
        $sql="SELECT * FROM presupuestos";
        $sq= $db->query($sql);
        $rows=$sq->fetchAll();
        foreach ($rows as $row) {
          $id_presupuesto=$row["id_presupuesto"];
          $id_cliente=$row["id_cliente"];
          $tiempo_desarrollo=$row["tiempo_desarrollo"];
          $requerimientos=$row["requerimientos"];
          $consideraciones=$row["consideraciones"];
          $fecha_presupuesto=$row["fecha_presupuesto"];
          $total_presupuesto=$row["total_presupuesto"];

          $sql_cliente="SELECT * FROM clientes where id_cliente='$id_cliente'";
          $sq_cliente= $db->query($sql_cliente);
          $rows_cliente=$sq_cliente->fetchAll();
          foreach ($rows_cliente as $row_cliente) {
            $cliente=$row_cliente["apaterno"]." ".$row_cliente["amaterno"]." ".$row_cliente["nombre"];
          }

          $sql_proyecto="SELECT * FROM proyectos where id_presupuesto='$id_presupuesto'";
          $sq_proyecto= $db->query($sql_proyecto);
          $rows_proyecto=$sq_proyecto->fetchAll();
          $total_presupuesto=0;
          foreach ($rows_proyecto as $row_proyecto) {
            $desc_producto=$row_proyecto["desc_producto"];
            $total_presupuesto=$total_presupuesto+$row_proyecto["total"];
          }

          $PDF='<button id="pdf_presupuesto" type="button" class="btn btn-romlex1 btn-sm" data-toggle="modal" data-target="#mod_proyecto" id="boton" data-whatever="@mdo"
            id_presupuesto="'.$id_presupuesto.'">
              <i class="far fa-file-pdf"></i> Generar PDF
            </button>';
         
          $editar='<button id="btn_mod_presupuesto" type="button" class="btn btn-romlex2 btn-sm" data-toggle="modal" data-target="#mod_presupuesto"
            id_presupuesto="'.$id_presupuesto.'"
            id_cliente="'.$id_cliente.'"
            tiempo_desarrollo="'.$tiempo_desarrollo.'"
            requerimientos="'.$requerimientos.'"
            consideraciones="'.$consideraciones.'"
            fecha_presupuesto="'.$fecha_presupuesto.'"
            total_presupuesto="'.$total_presupuesto.'">
              <i class="fas fa-edit"></i> Modificar
            </button>';

          $eliminar='<button type="button" class="btn btn-danger" id="del_presupuesto" 
            id_presupuesto="'.$id_presupuesto.'">
              <i class="fas fa-minus-circle"></i> Eliminar
            </button>';
      ?>
      <tr>
        <td><center><? echo $PDF; ?></center></td>
        <td><center><? echo $editar; ?></center></td>
        <td><? echo $fecha_presupuesto; ?></td>
        <td><? echo $cliente; ?></td>
        <td><? echo $total_presupuesto; ?></td>
        <td><center><? echo $eliminar; ?></center></td>
      </tr>
      <? } ?>
    </tbody>
  </table>
</div>

      