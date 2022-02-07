$(document).ready(function(){
  $("#form_calc").css("display", "none");
  $("#mdl_add_proyecto").attr("disabled", "true");
  llenar_select_clientes();
})

function add(id){
  var form=id;
  var datos = new FormData($(form)[0]);
  var action= $(form).attr("action");
  var enctype= $(form).attr("enctype");
  var method= $(form).attr("method");
  var nombre_form= $(form).attr("nombre_form");
  var modal= $(form).attr("modal");
  $.ajax({
    url: action,
    enctype: enctype,
    type: method,
    processData: false,
    contentType: false,
    data: datos,
    success: function (data) {
      if (data=="1") {
        alerta_correcto("Correcto",
          "Consulta asignada correctamente");
        $("#tabla").load(" #tabla", function(){
          tabla("Listado de "+nombre_form);
        });
        $('#'+modal).modal('toggle');
        limpiar_formulario(form);
        llenar_select_clientes();
      }else {
        alerta_error("Error",
          "A ocurrido un error al tratar de registrar");
        console.log("Error: "+data);
      }
    }
  });
}

function limpiar_formulario(form){
  $(form).trigger("reset");
}

function limpiar_formulario_presupuesto(){
  $('#id_presupuesto').val('');
  $('#tiempo_desarrollo').val('');
  $('#requerimientos').val('');
  $('#consideracion').val('');
  llenar_select_clientes();
}

function limpiar_formulario_proyecto(){
  //limpiar registro de proyecto
    $('#cantidad').val('');
    $('#prod_descr').val('');
    $('#material').val('');
    $('#color_acabado').val('');
    $('#observaciones').val('');
    $('#fecha_inicio').val('');
    $('#fecha_entrega').val('');
    $('#total').val('');

  //limpiar registro de costos
    $('#costo_requerido').val('');
    $('#porc_desgaste').val('');
    $('#total_desgaste').val('');
    $('#tiempo_req').val('');
    $('#total_tiempo_req').val('');
    $('#porc_utilidad').val('');
    $('#total_utilidad').val('');
    $('#subtotal').val('');
    $('#impuesto').val('');
    $('#total_iva').val('');
}

function llenar_select_clientes(){
  $.ajax({
    url:"php/cargar_clientes.php",
    method:"POST",
    dataType: 'json',
    success: function(data){
      $('#select_cliente').empty();
      $('#mod_select_cliente').empty();
      var array=Array.isArray(data);
      if(array==true){
        for(var i=0; i < data.length; i++){
          $("#select_cliente").append('<option value="'+data[i].id_cliente+'">'+data[i].nombre+'</option>');
          $("#mod_select_cliente").append('<option value="'+data[i].id_cliente+'">'+data[i].nombre+'</option>');
        }
        $('#select_cliente').selectpicker('refresh');
        $('#mod_select_cliente').selectpicker('refresh');
      }
    },error: function (jqXHR, textStatus, errorThrown) {
      console.log("Error: "+jqXHR.status+" - "+textStatus+" "+errorThrown);   
    }
  })
}

function llenal_mod_select_cliente(id_cliente){
  $.ajax({
    url:"php/cargar_clientes.php",
    method:"POST",
    dataType: 'json',
    success: function(data){
      $('#mod_select_cliente').empty();
      $('#mod_select_cliente').selectpicker('refresh');
      var array=Array.isArray(data);
      if(array==true){
        for(var i=0; i < data.length; i++){
          $("#mod_select_cliente").append('<option value="'+data[i].id_cliente+'">'+data[i].nombre+'</option>');
        }
        $('#mod_select_cliente').val(id_cliente);
        $('#mod_select_cliente').selectpicker('refresh');
      }
    },error: function (jqXHR, textStatus, errorThrown) {
      console.log("Error: "+jqXHR.status+" - "+textStatus+" "+errorThrown);   
    }
  })
}

function llenar_tabla_proyectos(id_presupuesto){
  $.ajax({
    url:"php/cargar_tabla_proyectos.php",
    type:"POST",
    data:{id_presupuesto:id_presupuesto},
    success: function(data){
      $('#tbody_proyectos').html(data);
    }
  })
  $.ajax({
    url:"php/calcular_total_presupuesto.php",
    type:"POST",
    data:{id_presupuesto:id_presupuesto},
    success: function(data){
      $('#campo_total').html(data);
    }
  })
  $.ajax({
    url:"php/calcular_tiempo_presupuesto.php",
    type:"POST",
    data:{id_presupuesto:id_presupuesto},
    success: function(data){
      $('#tiempo_desarrollo').val(data+' dias');
    }
  })
}

function limpiar_tabla_proyecto(){
  $('#tbody_proyectos').empty();
  $('#campo_total').empty();
  $("#mdl_add_proyecto").attr("disabled", "true");
}

function actualizar_tabla(){
  $("#tabla").load(" #tabla", function(){
    tabla("Listado de presupuestos");
  });
}
/*--- FUNCIONES PARA SECCION CLIENTE ---*/
  //MODIFICAR CLIENTE
    $(document).on('click', '#modificar_cliente',function(){
      $("#id_cliente").val($(this).attr('btn-id_cliente'));
      $("#apaterno_mod").val($(this).attr('btn-apaterno'));
      $("#amaterno_mod").val($(this).attr('btn-amaterno'));
      $("#nombre_mod").val($(this).attr('btn-nombre'));
      $("#telefono_mod").val($(this).attr('btn-telefono'));
      $("#domicilio_mod").val($(this).attr('btn-domicilio'));
      $("#email_mod").val($(this).attr('btn-email'));
    });

  //ELIMINAR CLIENTE
    $(document).on('click', '#del_cliente',function(){
      var id_cliente=$(this).attr('btn-id_cliente');
      Swal.fire({
        title: '¿Seguro que desea eliminar este presupuesto?',
        text: 'Todos los datos registrados para este presupuesto seran eliminados.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#424964',
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirmar",
        cancelButtonText: "Anular"
      }).then((result) => {
        if (result.value){
          $.ajax({
            url:"php/del_cliente.php",
            method:"POST",
            data:{id_cliente:id_cliente},
            success: function(data){
              if(data=="1"){
                alerta_correcto("Correcto","Datos del cliente eliminados correctamente"); 
                $("#menu-sidebar").load(" #menu-sidebar");
                $("#menu-navbar").load(" #menu-navbar");
                $("#tabla").load(" #tabla", function() {
                  tabla("Listado de Clientes");
                });
              }else{
                alerta_error("Error",mensaje_no); 
              }
            }
          })
        }
      }) 
    });
/*--- FUNCIONES PARA SECCION CLIENTE ---*/

/*--- FUNCIONES PARA SECCION PRESUPUESTOS ---*/
  //Crear id de nuevo presupuesto
    $(document).on('click','#mdl_add_presupuesto', function(){
      $.ajax({
        url:"php/add_idpresupuestoE.php",
        method:"POST",
        success: function(data){
          $("#id_presupuesto").val(data);
        }
      });
    })
  //Activar botón nuevo proyecto
    $(document).on('change','#select_cliente', function(){
      $("#mdl_add_proyecto").removeAttr("disabled");
    });
  //Registrar id de cliente en presupuesto
    $(document).on('click','#mdl_add_proyecto', function(){
      var id_presupuesto= $('#id_presupuesto').val();
      var id_cliente= $('#select_cliente').val();
      if (id_cliente>'0') {
        $('#add_proyecto').modal('show');
        $.ajax({
          url:"php/add_idclienteE.php",
          method:"POST",
          data:{id_presupuesto:id_presupuesto,
                id_cliente:id_cliente},
          success: function(data){
          }
        });
      }else{
        alert("Seleccione un cliente por favor.");
      }
      //llenar_tabla_proyectos(id_presupuesto);
    })
  //Registro de presupuesto
    $(document).on('click','#registrar_datos_presupuesto', function(){
      var id_presupuesto= $('#id_presupuesto').val();
      var id_cliente= $('#select_cliente').val();
      var tiempo_desarrollo= $('#tiempo_desarrollo').val();
      var requerimientos= $('#requerimientos').val();
      var consideracion= $('#consideracion').val();
      var total_presupuesto= $('#campo_total').html();  
      $.ajax({
        url:"php/finalizar_presupuesto.php",
        method:"POST",
        data:{id_presupuesto:id_presupuesto,
              id_cliente:id_cliente,
              tiempo_desarrollo:tiempo_desarrollo,
              requerimientos:requerimientos,
              consideracion:consideracion,
              total_presupuesto:total_presupuesto},
        success: function(data){
          if(data==1){
            Swal.fire({
              position: 'center',
              type: 'success',
              title: 'Correcto.',
              html: 'Presupuesto registrado correctamente',
              showConfirmButton: false,
              timer: 2000
            })
            $('#add_presupuesto').modal('toggle');
            limpiar_formulario_presupuesto();
            actualizar_tabla();
            limpiar_tabla_proyecto();
          }else{
            Swal.fire({
              position: 'center',
              type: 'error',
              title: 'Error.',
              html: 'A ocurrido un error, contacte al administrador del sistema',
              showConfirmButton: false,
              timer: 2000
            })
            $('#add_presupuesto').modal('toggle'); 
          }
        }
      });
    })
  //Cancelar registro presupuesto
    $(document).on('click', '#cancelar_registro_presupuesto',function(){
      var id_presupuesto= $('#id_presupuesto').val();
      Swal.fire({
        title: '¿Seguro que desea cancelar esta acción?',
        text: 'Todos los datos registrados para este presupuesto seran eliminados.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#424964',
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirmar",
        cancelButtonText: "Anular"
      }).then((result) => {
        if (result.value) {
          $ .ajax({
            url: 'php/del_presupuestos.php',
            method:"POST",
            data:{id_presupuesto: id_presupuesto},
            success: function(data){
              if(data==1){
                Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: 'Correcto.',
                  html: 'Presupuesto cancelado correctamente',
                  showConfirmButton: false,
                  timer: 2000
                })
                $('#add_presupuesto').modal('toggle');
                limpiar_formulario_presupuesto();
                limpiar_tabla_proyecto();
              }else{
                Swal.fire({
                  position: 'center',
                  type: 'error',
                  title: 'Error.',
                  html: 'A ocurrido un error, contacte al administrador del sistema',
                  showConfirmButton: false,
                  timer: 2000
                })
                $('#add_presupuesto').modal('toggle'); 
                alert("add_presupuesto");
              }
            }
          })
        }
      })
    })
    $(document).on('click', '#close_registro_presupuesto',function(){
      var id_presupuesto= $('#id_presupuesto').val();
      Swal.fire({
        title: '¿Seguro que desea cancelar esta acción?',
        text: 'Todos los datos registrados para este presupuesto seran eliminados.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#424964',
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirmar",
        cancelButtonText: "Anular"
      }).then((result) => {
        if (result.value) {
          $ .ajax({
            url: 'php/del_presupuestos.php',
            method:"POST",
            data:{id_presupuesto: id_presupuesto},
            success: function(data){
              if(data==1){
                Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: 'Correcto.',
                  html: 'Presupuesto cancelado correctamente',
                  showConfirmButton: false,
                  timer: 2000
                })
                $('#add_presupuesto').modal('toggle');
                limpiar_formulario_presupuesto();
                limpiar_tabla_proyecto();
              }else{
                Swal.fire({
                  position: 'center',
                  type: 'error',
                  title: 'Error.',
                  html: 'A ocurrido un error, contacte al administrador del sistema',
                  showConfirmButton: false,
                  timer: 2000
                })
                $('#add_presupuesto').modal('toggle'); 
              }
            }
          })
        }
      })
    })
  //eliminar datos presupuesto
    $(document).on('click','#del_presupuesto',function(){
      var id_presupuesto=$(this).attr('id_presupuesto');
      Swal.fire({
        title: '¿Seguro que desea eliminar este presupuesto?',
        text: 'Todos los datos registrados para este presupuesto seran eliminados.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#424964',
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirmar",
        cancelButtonText: "Anular"
      }).then((result) => {
        if (result.value) {
          $ .ajax({
            url: 'php/del_presupuestos.php',
            method:"POST",
            data:{id_presupuesto: id_presupuesto},
            success: function(data){
              if(data==1){
                Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: 'Correcto.',
                  html: 'Presupuesto Eliminado correctamente',
                  showConfirmButton: false,
                  timer: 2000
                })
                actualizar_tabla();
              }else{
                Swal.fire({
                  position: 'center',
                  type: 'error',
                  title: 'Error.',
                  html: 'A ocurrido un error, contacte al administrador del sistema',
                  showConfirmButton: false,
                  timer: 2000
                })
                $('#add_presupuesto').modal('toggle'); 
              }
            }
          })
        }
      })
    })
  //Modificar presupuesto
    $(document).on('click','#btn_mod_presupuesto', function(){
      $("#mod_id_presupuesto").val($(this).attr('id_presupuesto'));
      var id_cliente = $(this).attr('id_cliente');
      $("#mod_tiempo_desarrollo").val($(this).attr('tiempo_desarrollo'));
      $("#mod_requerimientos").val($(this).attr('requerimientos'));
      $("#mod_consideracion").val($(this).attr('consideraciones'));
      llenal_mod_select_cliente(id_cliente);
    })
/*--- FUNCIONES PARA SECCION PRESUPUESTOS ---*/

/*--- FUNCIONES PARA SECCION PROYECTOS ---*/
  //Calcular proyecto
    //activar form calcular
      $(document).on('click','#calcular_proyecto', function(){
        if($('#form_calc').css('display') == 'none'){
          $("#form_calc").css("display", "inline");
        }else{
          $("#form_calc").css("display", "none");
        } 
      });
    //Tiempo requerido
      $(document).on('click','#cal_tiemp', function(){
        if ($('#tiempo_req').val()=="") {
          alert("Es necesario colocar el 'Tiempo requerido'");
        }else{
          var tiempo_req=$('#tiempo_req').val();
          var resultado=tiempo_req*350;
          $('#total_tiempo_req').val(resultado);
        }
      });
    //Utilidad
      $(document).on('click','#cal_util', function(){
        if ($('#total_tiempo_req').val()=="") {
          alert("Primero debe calcular el 'Total por tiempo'");
        }else{
          if ($('#porc_utilidad').val()=="") {
            alert("Es necesario colocar un 'Porcentaje de utilidad'"); 
          }else{
            var total_tiempo_req = $('#total_tiempo_req').val();
            var porc_utilidad = $('#porc_utilidad').val();
            var resultado = (parseFloat(total_tiempo_req))*(porc_utilidad/100);
            $('#total_utilidad').val(resultado);
          }
        }
      });
    //Total
      $(document).on('click','#cal_total_iva', function(){
        if ($('#costo_requerido').val()=="") {
          alert("Es necesario colocar el 'Costo requerido'");
        }else{
          if ($('#total_tiempo_req').val()=="") {
            alert("Primero debe calcular el 'Total por tiempo'"); 
          }else{
            if ($('#total_utilidad').val()=="") {
              alert("Primero debe calcular el 'Total Utilidad'"); 
            }else{
              var costo_requerido = $('#costo_requerido').val();
              var total_tiempo_req = $('#total_tiempo_req').val();
              var total_utilidad = $('#total_utilidad').val();
              var subtotal = parseFloat(costo_requerido)+parseFloat(total_tiempo_req)+parseFloat(total_utilidad);
              var iva = parseFloat(subtotal)*0.16;
              var total_iva= parseFloat(iva)+parseFloat(subtotal);
              $('#subtotal').val(subtotal);
              $('#impuesto').val(iva);
              $('#total_iva').val(total_iva);
              $('#total').val(total_iva);
            }
          }
        }
      });
    //Registrar proyecto
      $(document).on('click','#registrar_datos_proyecto', function(){
        //registro datos proyecto
          var id_presupuesto= $('#id_presupuesto').val();
          var cantidad= $('#cantidad').val();
          var produc_desc= $('#prod_descr').val();
          var material= $('#material').val();
          var color_acabado= $('#color_acabado').val();
          var observaciones= $('#observaciones').val();
          var fecha_inicio= $('#fecha_inicio').val();
          var fecha_entrega= $('#fecha_entrega').val();
          var total= $('#total').val();
        //registro de costos
          var costo_requerido= $('#costo_requerido').val();
          var tiempo_req= $('#tiempo_req').val();
          var total_tiempo_req=parseFloat(tiempo_req)*335;
          var porc_utilidad= $('#porc_utilidad').val();
          var total_utilidad= $('#total_utilidad').val();
          var subtotal= $('#subtotal').val();
          var impuesto= $('#impuesto').val();
          var total_iva= $('#total_iva').val();
          var total_desgaste=parseFloat(tiempo_req)*15;

        $.ajax({
          url:"php/registro_proyectos.php",
          method:"POST",
          data:{id_presupuesto:id_presupuesto,
                cantidad:cantidad,
                produc_desc:produc_desc,
                material:material,
                color_acabado:color_acabado,
                observaciones:observaciones,
                fecha_inicio:fecha_inicio,
                fecha_entrega:fecha_entrega,
                total:total,
                costo_requerido:costo_requerido,
                total_desgaste:total_desgaste,
                tiempo_req:tiempo_req,
                total_tiempo_req:total_tiempo_req,
                porc_utilidad:porc_utilidad,
                total_utilidad:total_utilidad,
                subtotal:subtotal,
                impuesto:impuesto,
                total_iva:total_iva},
          success: function(data){
            if(data==1){
              Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Correcto.',
                html: 'Proyecto registrado correctamente',
                showConfirmButton: false,
                timer: 2000
              })
              $('#add_proyecto').modal('toggle');
              $("#form_calc").css("display", "none");
              limpiar_formulario_proyecto();
              llenar_tabla_proyectos(id_presupuesto);
            }else{
              Swal.fire({
                position: 'center',
                type: 'error',
                title: 'Error.',
                html: 'A ocurrido un error, contacte al administrador del sistema',
                showConfirmButton: false,
                timer: 2000
              })
              $('#add_proyecto').modal('toggle'); 
            }
          }
        });

      })
    //eliminar datos proyecto
    $(document).on('click','#del_proyecto',function(){
      var id_proyecto=$(this).attr('id_proyecto');
      var id_presupuesto= $('#id_presupuesto').val();
      Swal.fire({
        title: '¿Seguro que desea eliminar este proyecto?',
        text: 'Todos los datos registrados para este proyecto seran eliminados.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#424964',
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirmar",
        cancelButtonText: "Anular"
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url:"php/del_btn_proyectos.php",
            type:"POST",
            data:{id_proyecto:id_proyecto},
            success: function(data){
              if (data==1) {
                llenar_tabla_proyectos(id_presupuesto); 
              }else(
                 Swal.fire({
                  position: 'center',
                  type: 'error',
                  title: 'Error.',
                  html: 'A ocurrido un error, contacte al administrador del sistema',
                  showConfirmButton: false,
                  timer: 2000
                })
              )
            }
          })
        }
      })
    })
/*--- FUNCIONES PARA SECCION PROYECTOS ---*/