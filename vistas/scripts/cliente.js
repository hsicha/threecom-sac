var tabla;

//Función que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });
  $("#mVentas").addClass("treeview active");
  $("#lClientes").addClass("active");

  	$.post("../ajax/cliente.php?op=select_tipo_doc", function (r) {
      $("#idTipoDoc").html(r);
      $("#idTipoDoc").selectpicker("refresh");
    });
}

//Función limpiar
function limpiar() {
$("#idcliente").val("");
$("#nro_doc").val("");
$("#razon_social").val("");
$("#direccion").val("");
$("#telefono").val("");
$("#estado_sunat").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
  limpiar();
    if (flag) {
    $(".mdlClientes").modal("show");
  } else {
    $(".mdlClientes").modal("hide");
  }
}

//Función cancelarform
function cancelarform() {
  limpiar();
  mostrarform(false);
}

//Función Listar
function listar() {
   tabla = $("#tbllistado").DataTable({
 	lengthMenu: [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		bLengthChange: true,
		autoWidth: false,
		 bDestroy: true,
		 language: {
		   search: "Buscar por",
		   lengthMenu:    "Mostrar _MENU_ Elementos",
		   info:           "Mostrando _START_ a _END_ de _TOTAL_ Elementos",
		   infoEmpty:      "Mostrando 0 registros de 0 registros encontrados",
		   paginate: {
			 next: "<span>Siguiente</span>",
			 previous: "<span>Atras</span>",
		   },
		 },
	  
		 responsive: true,
		 searching: true,
		 "ajax":{
		   url: "../ajax/cliente.php?op=listar_cliente",
					   type : "get",
					   dataType : "json",						
					   error: function(e){
						   console.log(e.responseText);	
					   }
	   },
	 
	 });
}
//Función para guardar o editar

function guardaryeditar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  //$("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "../ajax/cliente.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
     mensaje(datos,"","success");
      mostrarform(false);
      tabla.ajax.reload();
    },
  });
  limpiar();
}

function mostrar(idcliente) {
  
	$.post("../ajax/cliente.php?op=mostrar",{idcliente : idcliente}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#idTipoDoc").val(data.cod_tipo_doc);
		$("#idTipoDoc").selectpicker("refresh");
		$("#nro_doc").val(data.num_documento);
		$("#razon_social").val(data.razon_social);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#estado_sunat").val(data.estado_sunat);
 		$("#idcliente").val(data.idcliente);
		

 	})
}


//Función para eliminar registros
function eliminar(idcliente) {
  bootbox.confirm("¿Está Seguro de eliminar el cliente?", function (result) {
    if (result) {
      $.post(
        "../ajax/cliente.php?op=eliminar",
        { idcliente: idcliente },
        function (e) {
          bootbox.alert(e);
          tabla.ajax.reload();
        }
      );
    }
  });
}

$("#btn_buscar_ruc_dni").click(function () {
  var dni = $("#nro_doc").val();
  if (dni.length == 8) {
    $.ajax({
      type: "POST",
      url: "../ajax/consultaDni.php",
      data: "dni=" + dni,
      dataType: "json",
      success: function (data) {
        if (data.numeroDocumento == dni) {
          $("#idTipoDoc").val(data.tipoDocumento);
          $("#idTipoDoc").selectpicker("refresh");
          $("#nroDoc").val(data.numeroDocumento);
          $("#razon_social").val(data.nombre);
          $("#direccion").val(data.direccion);
          $("#estado_sunat").val(data.estado);
          console.log(data);
        }
      },
    });
  } else if (dni.length == 11) {
    $.ajax({
      type: "POST",
      url: "../ajax/consultaRuc.php",
      data: "ruc=" + dni,
      dataType: "json",
      success: function (data) {
        if (data.numeroDocumento == dni) {
          $("#idTipoDoc").val(data.tipoDocumento);
          $("#idTipoDoc").selectpicker("refresh");
          $("#nroDoc").val(data.numeroDocumento);
          $("#razon_social").val(data.nombre);
          $("#direccion").val(data.direccion);
          $("#estado_sunat").val(data.estado);
          console.log(data);
        }
      },
    });
  }
});
function mensaje(title,text,icon){
	Swal.fire({
  title: title,
  text: text,
  icon: icon
});
}
init();
