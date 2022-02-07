<div id="tabla" class="table-responsive" style="padding-bottom: 15px;">
  <br>
  <script>
    $(document).ready(function() {
      tabla("Listado de Clientes");
    });
  </script>
  <table id="tabla-1" class="display nowrap" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="noExport">Editar</th>
      <!--<th class="noExport">Eliminar</th>-->
      <th>Nombre</th>
      <th>Telefono</th>
      <th>Domicilio</th>
      <th>Email</th>
      <th>Eliminar</th>
    </tr>
  </thead>
  <tbody>
    <? 
      $sql="SELECT * FROM clientes";
      $sq= $db->query($sql);
      $rows=$sq->fetchAll();
      foreach ($rows as $row) {
       $id_cliente=$row["id_cliente"];
       $nombre=$row["apaterno"]." ".$row["amaterno"]." ".$row["nombre"];
       $domicilio=$row["domicilio"];
       $telefono=$row["telefono"];
       $email=$row["email"];
       $editar='<button id="modificar_cliente" type="button" class="btn btn-romlex2 btn-sm" data-toggle="modal" data-target="#mod_clientes" id="boton" data-whatever="@mdo"
            btn-id_cliente="'.$id_cliente.'"
            btn-apaterno="'.$row["apaterno"].'"
            btn-amaterno="'.$row["amaterno"].'"
            btn-nombre="'.$row["nombre"].'"
            btn-domicilio="'.$domicilio.'"
            btn-telefono="'.$telefono.'"
            btn-email="'.$email.'"
         >Modificar</button>';

        $eliminar='<button type="button" class="btn btn-danger" id="del_cliente" btn-id_cliente="'.$id_cliente.'">Eliminar</button>';
    ?>
    <tr>
      <td><center><? echo $editar; ?></center></td>
      <!--<td><center><? /*echo $eliminar;*/ ?></center></td>-->
      <td><? echo $nombre; ?></td>
      <td><? echo $telefono; ?></td>
      <td><? echo $domicilio; ?></td>
      <td><? echo $email; ?></td>
      <td><? echo $eliminar; ?></td>
    </tr>
    <? } ?>
  </tbody>
</table>