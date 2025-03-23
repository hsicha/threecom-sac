var tabla;

//Función que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });
  $("#mAlmacen").addClass("treeview active");
  $("#lCategorias").addClass("active");

  
}

//Función limpiar
function limpiar() {
  $("#idalmacen").val("");
  $("#nombre").val("");
  $("#descripcion").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
  limpiar();
  if (flag) {
    $("#listadoregistros").hide();
    $("#formularioregistros").show();
    $("#btnGuardar").prop("disabled", false);
    $("#btnagregar").hide();
  } else {
    $("#listadoregistros").show();
    $("#formularioregistros").hide();
    $("#btnagregar").show();
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
		   url: '../ajax/almacen.php?op=listar',
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
    url: "../ajax/almacen.php?op=guardareditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
      mensaje(datos,"","success")
      $(".myModal").modal("hide");
      tabla.ajax.reload();
    },
  });
  limpiar();
}

function mostrar(idalmacen) {
  $.post(
    "../ajax/almacen.php?op=mostrar_detalle",
    { idalmacen: idalmacen },
    function (data, status) {
      data = JSON.parse(data);
      $(".myModal").modal("show");
      $("#nombre").val(data.nombre);
      $("#descripcion").val(data.descripcion);
      $("#idalmacen").val(data.codigo_almacen);
     
    }
  );
}

//Función para desactivar registros
function desactivar(idalmacen) {
  bootbox.confirm(
    "¿Está Seguro de desactivar almacen ?",
    function (result) {
      if (result) {
        $.post(
          "../ajax/almacen.php?op=desactivar",
          { idalmacen: idalmacen },
          function (e) {
            bootbox.alert(e);
            tabla.ajax.reload();
          }
        );
      }
    }
  );
}

//Función para activar registros
function activar(idalmacen) {
  bootbox.confirm("¿Está Seguro de activar la Almacen?", function (result) {
    if (result) {
      $.post(
        "../ajax/almacen.php?op=activar",
        { idalmacen: idalmacen },
        function (e) {
          bootbox.alert(e);
          tabla.ajax.reload();
        }
      );
    }
  });
}
function mensaje(title,text,icon){
	Swal.fire({
  title: title,
  text: text,
  icon: icon
});
}
init();
