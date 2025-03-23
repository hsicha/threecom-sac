var tabla;

//Función que se ejecuta al inicio
function init() {
  $(".myModal").modal({ backdrop: "static", keyboard: false });
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });
  $("#ltipodoc").addClass("treeview active");
  $("#ltipodoc").addClass("active");

  $.post("../ajax/tipoDoc.php?op=select_doc", function (r) {
    $("#codigo_doc").html(r);
    $("#codigo_doc").selectpicker("refresh");
  });
}

//Función limpiar
function limpiar() {
  $("#idtipodocumento").val("");
  $("#codigo_doc").val("");
  $("#codigo_doc").selectpicker("refresh");
  $("#serie").val("");
   $("#numeracion").val("");

}

//Función mostrar formulario
function mostrarform(flag) {
  limpiar();
  if (flag) {
    $(".myModal").modal("show");
  } else {
     $(".myModal").modal("hide");
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
		   url: '../ajax/tipoDoc.php?op=listar',
					   type : "get",
					   dataType : "json",						
					   error: function(e){
						   console.log(e);	
					   }
	   },
	 
	 });
}
//Función para guardar o editar

function guardaryeditar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  //$("#btnGuardar").prop("disabled",true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "../ajax/tipoDoc.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos,status) {
     mensaje(datos,status,"success")
      $(".myModal").modal("hide");
      tabla.ajax.reload();
    },
  });
  limpiar();
}

function mostrar(idtipodocumento) {
  $.post(
    "../ajax/tipoDoc.php?op=mostrar",
    { idtipodocumento: idtipodocumento },
    function (data, status) {
      data = JSON.parse(data);
    $(".myModal").modal("show");
  $("#codigo_doc").val(data.idtipo_doc);
      $("#codigo_doc").selectpicker("refresh");
      console.log(data.nombre_documento);
      $('#serie').val(data.num_serie);
      $("#idtipodocumento").val(data.idtipo_documento);
      $("#numeracion").val(data.nro_inicial);
    }
  );
}

//Función para desactivar registros
function eliminar(idtipodocumento) {
 Swal.fire({
  title: "EASTA SEGURO DE ELIMINAR ESTE REGISTRO ?",
  text: "eliminar",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Confirmar"
}).then((result) => {
  if (result.isConfirmed) {
    $.post("../ajax/tipoDoc.php?op=eliminar",{idtipodocumento:idtipodocumento},
    function(data, status){
    	mensaje(data,status,"success");
    	tabla.ajax.reload();
    })
  }
});
	limpiar();
}

//Función para activar registros
function activar(idtipodocumento) {
  bootbox.confirm("¿Está Seguro de activar la Categoría?", function (result) {
    if (result) {
      $.post(
        "../ajax/tipoDoc.php?op=activar",
        { idtipodocumento: idtipodocumento },
        function (e) {
          bootbox.alert(e);
          tabla.ajax.reload();
        }
      );
    }
  });
}
// funciones del select
function seleccionar_odcumento(){
    var documento = document.getElementById("codigo_doc").value;
    var codigo_documneto = document.getElementById("codigo_doc");
    var seleccion=codigo_documneto.options[codigo_documneto.selectedIndex].text;
    if(documento=="1" ||documento=="3" || documento=="7" || documento=="8"){
        $("#nombre_doc").val(seleccion);
    }
    if(documento=="0"){
        bootbox.alert("debe seleccionar documento diferente");
        $("#nombre_doc").val(seleccion);
    }
}
function mensaje(title,text,icon){
	Swal.fire({
  title: title,
  text: text,
  icon: icon
});
}
init();
