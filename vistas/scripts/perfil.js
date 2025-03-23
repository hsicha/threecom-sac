var tabla;
//Función que se ejecuta al inicio
function init(){
	
	 $("form").keypress(function (e) {
        var key;
        if (window.event)
            key = window.event.keyCode; //IE
        else
            key = e.which; //firefox     
        return (key != 13);
    });
	mostrarform(false);
	listar();


    $('#mAcceso').addClass("treeview active");
    $('#lPerfil').addClass("active");
}

function limpiar()
    {
        $('#idPerfil').val("");

        $("#descripcion").val("");

    }
//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}
//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}
//Función Listar
function listar()
{
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
		   url: '../ajax/perfil.php?op=listar',
					   type : "get",
					   dataType : "json",						
					   error: function(e){
						   console.log(e.responseText);	
					   }
	   },
	 
	 });
}

$("#btnGuardar").on("click",function(e){
	e.preventDefault();
	var idPerfil=$("#idPerfil").val();
	if(idPerfil===""){
		insertar_perfil();
	}else{
		actualizar_perfil();
	}
	
})
function insertar_perfil() {
 // $("#btnGuardar").prop("disabled", true);
   var data_perfil={
   	descripcion:$("#descripcion").val()
   }
   console.log(data_perfil);
  
$.post("../ajax/perfil.php?op=guardar_perfil",data_perfil,
 function(datos,estado){
 	mensaje(datos,"","success")
     $(".myModal").modal("hide");
      tabla.ajax.reload();
 })
  limpiar();
}

function actualizar_perfil(){
	var data_perfil=
	{idPerfil:$("#idPerfil").val(),
	 descripcion:$("#descripcion").val()
	};
	$.post("../ajax/perfil.php?op=actualizar_perfil",data_perfil,
 function(datos,estado){
 	mensaje(datos,"","success")
     $(".myModal").modal("hide");
      tabla.ajax.reload();
 })
  limpiar();
}
function mostrar(idPerfil) {
  $.post(
    "../ajax/perfil.php?op=mostrar_perfil",
    { idPerfil: idPerfil },
    function (data, status) {
      data = JSON.parse(data);
      $(".myModal").modal("show");
      $("#descripcion").val(data.desc_perfil);
      $("#idPerfil").val(data.id_perfil);
    }
  );
}
//Función para desactivar registros
function elimianr_perfil(idPerfil){
	Swal.fire({
  title: "EASTA SEGURO DE ELIMINAR ESTE PERFIL DE USUARIO ?",
  text: "eliminar",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Confirmar"
}).then((result) => {
  if (result.isConfirmed) {
    $.post("../ajax/perfil.php?op=eliminar_perfil",{idPerfil:idPerfil},
    function(data, status){
    	mensaje(data,status,"success");
    	tabla.ajax.reload();
    })
  }
});
	limpiar();
}


//Función para activar registros
function activar(idmarca)
{
	bootbox.confirm("¿Está Seguro de activar la Marca?", function(result){
		if(result)
        {
        	$.post("../ajax/marca.php?op=activar", {idmarca : idmarca}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}
function mensaje(title,text,icon){
	Swal.fire({
  title: title,
  text: text,
  icon: icon
});
}

init();