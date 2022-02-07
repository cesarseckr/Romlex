<div class="modal fade"  style="overflow-y: scroll;" id="add_presupuesto" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fas fa-plus-circle"></i>&nbsp; Registro nuevo presupuesto
        </h5>
         <button type="button" class="close" id="close_registro_presupuesto" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <? include("php/add_clientes.php"); ?>

      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-12">
            <div class="row">
              <div class="form-group col-12" style="display:inline">
                <label>Id_presupuesto:</label>
                <input type="text" class="form-control" placeholder="Producto/Descripción" name="id_presupuesto" id="id_presupuesto">
              </div>
              <div class="form-group col-12">
                <label>Cliente</label>
                <div class="form-row">
                  
                  <SELECT name="select_cliente" id="select_cliente" class="selectpicker form-control col-10" data-live-search="true" data-live-search-normalize="true" title="Seleccione Cliente" data-validation="required" data-validation-error-msg="<p style='color:#B40431;'>Ingrese nombre del Cliente</p>"></SELECT>

                  <div class="col-1"></div>
                  <button class="btn btn-icons btn-romlex2" data-toggle="modal" data-target="#add_cliente" id="mdl_add_cliente" data-whatever="@mdo"><i class="mdi mdi-account-plus"></i></button>
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
                    <INPUT type="text" class="form-control" id="tiempo_desarrollo">
                  </div>
                  <div class="form-group col-4">
                    <label>Requerimientos</label>
                    <textarea type="text" class="form-control" id="requerimientos"></textarea>
                  </div>
                  <div class="form-group col-4">
                    <label>Consideración</label>
                    <textarea type="text" class="form-control" id="consideracion"></textarea>
                  </div>
                </div>              
              </div>
            </div>
          </div>   
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-romlex2"  id="registrar_datos_presupuesto">Registrar</button>
        <button  type="button" class="btn btn-danger" id="cancelar_registro_presupuesto">
          <i class="fa fa-times"></i>Cancelar
        </button>
      </div>
    </div>
  </div>
</div>

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