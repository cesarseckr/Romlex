<div class="modal fade"  style="overflow-y: scroll;" id="mod_presupuesto" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fas fa-edit"></i>&nbsp; Modificar presupuesto
        </h5>
         <button type="button" class="close" id="close_mod_presupuesto" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <? include("php/mod_add_clientes.php"); ?>

      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-12">
            <div class="row">
              <div class="form-group col-12" style="display:inline">
                <label>Id_presupuesto:</label>
                <input type="text" class="form-control" placeholder="Producto/Descripción" name="mod_id_presupuesto" id="mod_id_presupuesto">
              </div>
              <div class="form-group col-12">
                <label>Cliente</label>
                <div class="form-row">
                  
                  <SELECT name="mod_select_cliente" id="mod_select_cliente" class="selectpicker form-control col-10" data-live-search="true" data-live-search-normalize="true" title="Seleccione Cliente" data-validation="required" data-validation-error-msg="<p style='color:#B40431;'>Ingrese nombre del Cliente</p>"></SELECT>

                  <div class="col-1"></div>
                  <button class="btn btn-icons btn-romlex2" data-toggle="modal" data-target="#mod_add_cliente" id="mdl_add_cliente" data-whatever="@mdo"><i class="mdi mdi-account-plus"></i></button>
                </div>
                <br>
                <div class="form-row">
                  <button class="btn btn-romlex2 col-12" id="mdl_add_proyecto"><i class="mdi mdi-account-plus"></i>Añadir nuevo proyecto</button>
                </div>
                <div  class="table-responsive" style="padding-bottom: 15px;">
                  <table id="tabla_resupuestos" class="table table-bordered" cellspacing="0" width="100%">  
                    <thead>
                      <tr>
                        <th>Cant.</th>
                        <th>Descripción o Producto</th>
                        <th>Precio Unit.</th>
                        <th>Total</th>
                        <th class="noExport"></th>
                        <th class="noExport"></th>
                      </tr>
                    </thead>
                    <tbody id="tbody_proyectos">
                      
                    </tbody>
                    <tfoot>
                      <tr> 
                        <th></th>
                        <th></th>
                        <th>TOTAL</th>
                        <th id="campo_total"></th>
                      </tr>
                    </tfoot>  
                  </table>    
                </div>
                <div class="row">
                  <div class="form-group col-4">
                    <label>Tiempo de desarrollo</label>
                    <INPUT type="text" class="form-control" id="mod_tiempo_desarrollo">
                  </div>
                  <div class="form-group col-4">
                    <label>Requerimientos</label>
                    <textarea type="text" class="form-control" id="mod_requerimientos"></textarea>
                  </div>
                  <div class="form-group col-4">
                    <label>Consideración</label>
                    <textarea type="text" class="form-control" id="mod_consideracion"></textarea>
                  </div>
                </div>              
              </div>
            </div>
          </div>   
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-romlex2"  id="mod_datos_presupuesto">Registrar</button>
        <button  type="button" class="btn btn-danger" id="cancelar_mod_presupuesto">
          <i class="fa fa-times"></i>Cancelar
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '#cancelar_mod_presupuesto',function(){
    $('#mod_presupuesto').modal('toggle'); 
  })
  $(document).on('click', '#close_mod_presupuesto',function(){
    $('#mod_presupuesto').modal('toggle'); 
  })
</script>

<script>
  $successMsg = $(".alert");
  $.validate({
    form : '#form-cliente',
    errorMessageClass: "error",
    onSuccess: function(){
      add("#form-cliente");
      $successMsg.show();
      return false; 
    }
  });
</script>