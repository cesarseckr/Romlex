<div class="modal fade"  style="overflow-y: scroll;" id="add_proyecto" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fas fa-plus-circle"></i>&nbsp; Registro nuevo proyecto
        </h5>
         <button type="button" class="close" id="close_registro_proyectos" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12">
              <div class="row">
                <div class="form-group col-12">
                  <label>Cantidad:</label>
                  <input type="text" class="form-control" placeholder="Cantidad" name="cantidad" id="cantidad">
                </div>
                <div class="form-group col-4">
                  <label>Producto/Descripción:</label>
                  <input type="text" class="form-control" placeholder="Producto/Descripción" name="prod_descr" id="prod_descr">
                </div>
                <div class="form-group col-4">
                  <label>Material:</label>
                  <input type="text" class="form-control" placeholder="Material" name="material" id="material">
                </div>
                <div class="form-group col-4">
                  <label>Color y Acabado:</label>
                  <input type="text" class="form-control" placeholder="Color y Acabado" name="color_acabado" id="color_acabado">
                </div>
                <div class="form-group col-12">
                  <label>Observaciones:</label>
                  <textarea type="text" class="form-control" placeholder="Observaciones" name="observaciones" id="observaciones"></textarea>
                </div>
                <div class="form-group col-5">
                  <label>Fecha de inicio:</label>
                  <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                </div>
                <div class="form-group col-5">
                  <label>Fecha de entrega:</label>
                  <input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega">
                </div>
                <div class="col-1"></div>
                <button class="btn btn-icons btn-romlex2" id=""><i class="fas fa-calendar-alt"></i></button>

<!-- --------------------------------------------------------------------------------------------------- -->
                <div class="col-12" id="form_calc">
                  <div class="form-group col-md-12">
                    <div class="row">
                      <hr>

                      <div class="form-group col-12">
                        <label>Costo Requerido (materiales):</label>
                        <input type="text" class="form-control" name="costo_requerido" id="costo_requerido">
                      </div>

                      <div class="form-group col-12">
                        <div class="row">
                          <div class="form-group col-6">
                            <label>Tiempo requerido:</label>
                            <div class="row">
                              <input type="text" class="form-control col-10" name="tiempo_req" id="tiempo_req" placeholder="horas de trabajo">
                              <button id="cal_tiemp" class=" col-2 btn btn-romlex1">=</button>
                            </div>
                          </div>
                          <div class="form-group col-6">
                            <label>Total por tiempo</label>
                            <input type="text" class="form-control" name="total_tiempo_req" id="total_tiempo_req">
                          </div>
                        </div>
                      </div>

                      <div class="form-group col-12">
                        <div class="row">
                          <div class="form-group col-6">
                            <label>Porcentaje de utilidad:</label>
                            <div class="row">
                              <input type="text" class="form-control col-10" name="porc_utilidad" id="porc_utilidad" placeholder="cantidad %">
                              <button id="cal_util" class=" col-2 btn btn-romlex1">=</button>
                            </div>
                          </div>
                          <div class="form-group col-6">
                            <label>Total Utilidad</label>
                            <input type="text" class="form-control" name="total_utilidad" id="total_utilidad">
                          </div>
                        </div>
                      </div>

                      <div class="form-group col-12">
                        <label>Subtotal:</label>
                        <div class="row">
                          <input type="text" class="form-control col-5" name="subtotal" id="subtotal">
                        </div>
                      </div>
                    
                      <div class="form-group col-12">
                        <label>IVA:</label>
                        <div class="row">
                          <input type="text" class="form-control col-5" name="impuesto" id="impuesto">
                        </div>
                      </div>
                    
                      <div class="form-group col-12">
                        <label>Total+IVA:</label>
                        <div class="row">
                          <input type="text" class="form-control col-5" name="total_iva" id="total_iva">
                          <div class="col-3"></div>
                          <button id="cal_total_iva" class=" col-2 btn btn-romlex1">=</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
<!-- --------------------------------------------------------------------------------------------------- -->

                <div class="form-group col-12">
                  <label>Total:</label>
                  <div class="form-row">
                    <input type="text" class="form-control col-10" placeholder="Total" name="total" id="total">
                    <div class="col-1"></div>
                    <button class="btn btn-icons btn-romlex2" id="calcular_proyecto"><i class="fas fa-calculator"></i></button>
                  </div>
                </div>
              </div>
            </div>   
            </div>
             </div>

            <div class="modal-footer">
              <button class="btn btn-romlex2"  id="registrar_datos_proyecto">Registrar</button>
              <button  type="button" class="btn btn-danger" id="cancelar_registro_proyectos">
                <i class="fa fa-times"></i>Cancelar
              </button>
            </div>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '#cancelar_registro_proyectos',function(){
    $('#add_proyecto').modal('toggle');
    limpiar_formulario_proyecto();
    $("#form_calc").css("display", "none");
  })
  $(document).on('click', '#close_registro_proyectos',function(){
    $('#add_proyecto').modal('toggle'); 
    limpiar_formulario_proyecto();
    $("#form_calc").css("display", "none");
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