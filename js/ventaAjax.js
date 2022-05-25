document.addEventListener('DOMContentLoaded', function() {

    var producto;
    var cliente;

    document.getElementById('venta_fecha').valueAsDate = new Date();

    //Boton que muestra el diálogo de agregar producto
    /*$('#agregarpv').click(function() {
      LimpiarFormulario();
      $("#unidades_p").val("1");
      $("#addNewProduct").modal();
    });*/

    //Boton que agrega el producto al detalle
    $('#addProduct').click(function() {
      RecolectarDatosFormulario();
      /*$("#addNewProduct").modal('hide');
      if ($("#unidades_p").val() == "") { //Controlamos que no esté vacío la cantidad de productos
        alert('No puede estar vacío la cantidad de productos.');
        return;
      }*/
      EnviarInformacionProducto("agregar");
    });

    //Boton terminar factura
    $('#btnTerminarFactura').click(function() {
      $("#ModalFinFactura").modal();
    });

    //Boton confirmar factura
    $('#confirmarVenta').click(function() {
      if ($('#CodigoCliente').val() == 0) {
        alert('Debe seleccionar un cliente');
        return;
      }
      RecolectarDatosCliente();
      EnviarInformacionFactura("confirmarfactura");
    });

    //Boton que descarta la factura generada borrando tanto en la tabla de facturas como detallefactura
    $('#descartarVenta').click(function() {
      RecolectarDatosCliente();
      EnviarInformacionFactura("confirmardescartarfactura");
    });

    //Boton confirmar factura y ademas genera pdf
    $('#mostrarVenta').click(function() {
      if ($('#CodigoCliente').val() == 0) {
        alert('Debe seleccionar un cliente');
        return;
      }
      RecolectarDatosCliente();
      EnviarInformacionFacturaImprimir("confirmarfactura");
    });

    function RecolectarDatosFormulario() {
      producto = {
        idproducto: $('#select_product').val(),
        cantidad: $('#unidades_p').val()
      };
    }

    function RecolectarDatosCliente() {
      cliente = {
        codigocliente: $('#CodigoCliente').val(),
        fecha: $('#Fecha').val()
      };
    }

    //Funciones AJAX para enviar y recuperar datos del servidor
    //******************************************************* 
    function EnviarInformacionProducto(accion) {
      $.ajax({
        type: 'POST',
        url: 'venta_guardar.php?accion=' + accion + '&codigo=' + <?php echo $codigofactura; ?>,
        data: producto,
        success: function(msg) {
          RecuperarDetalle();
        },
        error: function() {
          alert("Hay un error ..");
        }
      });
    }

    function EnviarInformacionFactura(accion) {
      $.ajax({
        type: 'POST',
        url: 'procesar.php?accion=' + accion + '&codigofactura=' + <?php echo $codigofactura ?>,
        data: cliente,
        success: function(msg) {
          window.location = 'index.php';
        },
        error: function() {
          alert("Hay un error ..");
        }
      });
    }

    function EnviarInformacionFacturaImprimir(accion) {
      $.ajax({
        type: 'POST',
        url: 'procesar.php?accion=' + accion + '&codigofactura=' + <?php echo $codigofactura ?>,
        data: cliente,
        success: function(msg) {
          window.open('pdffactura.php?' + '&codigofactura=' + <?php echo $codigofactura ?>, '_blank');
          window.location = 'index.php';
        },
        error: function() {
          alert("Hay un error ..");
        }
      });
    }


    function LimpiarFormulario() {
      $('#unidades_pv').val('');
    }



  });

  //Se ejecuta cuando se presiona un boton de borrar un item del detalle
  var cod;

  function borrarItem(coddetalle) {
    cod = coddetalle;
    $("#ModalConfirmarBorrar").modal();
  }

  $('#btnConfirmarBorrado').click(function() {
    $("#ModalConfirmarBorrar").modal('hide');
    $.ajax({
      type: 'POST',
      url: 'borrarproductodetalle.php?codigo=' + cod,
      success: function(msg) {
        RecuperarDetalle();
      },
      error: function() {
        alert("Hay un error ..");
      }
    });
  });




  function RecuperarDetalle() {
    $.ajax({
      type: 'GET',
      url: 'recuperardetalle.php?codigofactura=' + <?php echo $codigofactura ?>,
      success: function(datos) {
        document.getElementById('DetalleFactura').innerHTML = datos;
      },
      error: function() {
        alert("Hay un error ..");
      }

    });

  }