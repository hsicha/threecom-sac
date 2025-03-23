var tabla;

//Función que se ejecuta al inicio
function init() {
  //mostrarform(false);
  listar();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });
  $("#mAcceso").addClass("treeview active");
  $("#lsedes").addClass("active");

  //llenado de select
   $.post("../ajax/sedes.php?op=select_usuario", function (r) {
  
     $("#idusuario").html(r);
     $("#idusuario").selectpicker("refresh");
   });

      $.post("../ajax/sedes.php?op=select_almacen", function (r) {
       
        $("#codigo_almacen").html(r);
        $("#codigo_almacen").selectpicker("refresh");
      });
       $.post("../ajax/sedes.php?op=obtener_ubigeo", function (r) {
         $("#id_ubigeo").html(r);
         $("#id_ubigeo").selectpicker("refresh");
       });
}

//Función limpiar


//Función mostrar formulario

function mostrarform(flag){
if(flag){
$(".mdlempresa").modal("show");
limpiar();
}
	
}
//Función cancelarform


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
		   url: '../ajax/sedes.php?op=listar',
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
    url: "../ajax/sedes.php?op=guardaryeditar",
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

function mostrar(idsede) {
  $.post(
    "../ajax/sedes.php?op=mostrar",
    { idsede: idsede },
    function (data, status) {
      console.log(data);
      data = JSON.parse(data);
      mostrarform(true);
      $("#direccion").val(data.DIRECCION);
      $("#id_ubigeo").val(data.id_ubigeo);
      $("#id_ubigeo").selectpicker("refresh");
      $("#ubigeo").val(data.UBIGEO);
      $("#nombre_sede").val(data.NOMBRE_SEDE);
      $("#tel_celular").val(data.TEL_CELULAR);
      $("#anexo").val(data.ANEXO);
      $("#idusuario").selectpicker('refresh');
      $("#idsede").val(data.ID_SEDE);
      
    }
  );
}

function limpiar(){
      $("#direccion").val("");
      $("#id_ubigeo").val("");
      $("#id_ubigeo").selectpicker("refresh");
     // $("#ubigeo").val(data.UBIGEO);
      $("#nombre_sede").val("");
      $("#tel_celular").val("");
      $("#anexo").val("");
      $("#idsede").val("");
}
//Función para eliminar registros
function elimianr_sede(idsede){
 	
  Swal.fire({
  title: "EASTA SEGURO DE ELIMINAR  A LA SUCURSAL ?",
  text: "eliminar",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Confirmar"
}).then((result) => {
  if (result.isConfirmed) {
    $.post("../ajax/sedes.php?op=eliminar_sede",{idsede:idsede},
    function(data, status){
    
    	mensaje(data,status,"success");
    	tabla.ajax.reload();
    })
  }
});
	limpiar();
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


$("#id_ubigeo").on('change',function(){
  var id_ubigeo= document.getElementById("id_ubigeo").value;
  $.post(
    "../ajax/sedes.php?op=obtener_codigo_ubigeo",
    { id_ubigeo: id_ubigeo },
    function (data, status) {
      data = JSON.parse(data);
      $("#ubigeo").val(data.codigo_ubigeo);
    }
  );
})
function mensaje(title,text,icon){
  Swal.fire({
  title: title,
  text: text,
  icon: icon
});
}
init();
