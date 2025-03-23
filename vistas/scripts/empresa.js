var tabla;

//Función que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });
  $("#mAcceso").addClass("treeview active");
  $("#lEempresa").addClass("active");

  
}

//Función limpiar
function limpiar() {
  $("#idproveedor").val("");
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
    $(".mdlempresa").modal("show");
  } else {
    $(".mdlempresa").modal("hide");
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
		   url: '../ajax/empresa.php?op=listar',
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
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "../ajax/empresa.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
     mensaje(datos,"","success")
      mostrarform(false);
      tabla.ajax.reload();
    },
  });
  limpiar();
}

function mostrar(id_empresa) {
  $.post(
    "../ajax/empresa.php?op=mostrar",
    { id_empresa: id_empresa },
    function (data, status) {
      console.log(data);
      data = JSON.parse(data);
      mostrarform(true);
      $("#empresa").val(data.nom_empresa);
      $("#nombre_comercial").val(data.nombre_comercial);
      $("#ruc").val(data.ruc);
      $("#domicilio_fiscal").val(data.domicilio_fiscal);
      $("#ubigeo").val(data.ubigeo);
      $("#telefono_fijo").val(data.telefono_fijo);
      $("#telefono_movil").val(data.telefono_movil);
      $("#correo").val(data.correo);
      $("#imagenmuestra").attr("src", "../files/logos/" + data.logo);
      $("#imagenactual").val(data.logo);
      $("#id_empresa").val(data.id_empresa);
    }
  );
}

//Función para eliminar registros
function desactivar(id_empresa) {
  bootbox.confirm("¿Está Seguro de desactivar el empresa?", function (result) {
    if (result) {
      $.post(
        "../ajax/empresa.php?op=desactivar",
        { id_empresa: id_empresa },
        function (e) {
          bootbox.alert(e);
          tabla.ajax.reload();
        }
      );
    }
  });
}

function activar(id_empresa) {
  bootbox.confirm("¿Está Seguro de activar el empresa?", function (result) {
    if (result) {
      $.post(
        "../ajax/empresa.php?op=activar",
        { id_empresa: id_empresa },
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
