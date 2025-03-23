var tabla;



//Función que se ejecuta al inicio
function init() {
  $("form").keypress(function (e) {
    var key;
    if (window.event) key = window.event.keyCode; //IE
    else key = e.which; //firefox
    return key != 13;
  });
  listar();

  
     $.post("../ajax/estado_orden.php?op=select_estado_orden", function (r) {
     $("#cbo_estado").html(r);
     $("#cbo_estado").selectpicker("refresh");
     
   });
  mostrarform(false);

  //

  // Sigue siendo el día de hoy, pero con la hora cambiada a 0.

 
     


  $("#mOrden").addClass("treeview active");
  $("#lOrden").addClass("active");

  //cobo tipo doc
}
function fecha_actual() {
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear() + "-" + month + "-" + day;

 
 
}

//Función limpiar

//Función mostrar formulario

//Función Listar

function listar() {
	console.log("dataaxa")
	
tabla = $("#tbllistado").DataTable({
 	lengthMenu: [100 , 150, 200, 250, 300],//mostramos el menú de registros a revisar
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
		   url: '../ajax/estado_orden.php?op=listar_estado_orden',
					   type : "get",
					   dataType : "json",						
					   error: function(e){
						   console.log(e.responseText);	
					   }
	   },
	 
	 });
	

  
}
function modificar_estado(idOrden){
$(".mdlestado").modal('show')
$.ajax({
	 type: "POST",
    url: "../ajax/estado_orden.php?op=mostrar_estado",
    data: { idOrden: idOrden },
    dataType: "JSON",
    success: function (data) {
    	console.log(data);
     $("#nro_orden").val(data.nro_orden);
     $("#idOrden").val(data.idOrden);
     $("#costo_total").val(data.costo_total);
     $("#adelanto").val(data.adelanto);
     $("#diferencia").val(data.diferencia)
     $("#costo_repuesto").val(data.costo_repuesto)
     $("#solucion").val(data.solucion)
     $("#cbo_estado").val(data.id_estado)
     $("#cbo_estado").selectpicker("refresh");
    }
})

}

//Función ListarArticulos

// funcion para la opcion  seleccionar mode de pago

$("#btnGuardar").on("click", function (e) {
  e.preventDefault();
  var formData = new FormData($("#formulario_estado")[0]);
  
  $.ajax({
    type: "POST",
    url: "../ajax/estado_orden.php?op=modificar_estado_orden",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
    	console.log(data)
     mensaje(data,"","success")
		 cancelarform ()
        listar();
       
		//limpiar();
    },
    
  });


 
});
function cancelarform (){
	$(".mdlestado").modal('hide')
}

function imprimir_tick(id) {
	
	
	
 // window.open("../ajax/pdf_ticket/0000010-SICHA ROMANI HERNAN.pdf")
  $("#cnt_1").attr("src", "../ajax/pdf_ticke_orden.php?id=" + id + "&opc=imprime_ticket");
	
  
  $("#mdlPDF1").modal("show");
}
function enviar_whatsap(idOrden){
	$("#mdlwasap").modal("show");
	$.ajax({
    type: "POST",
    url: "../ajax/orden_servicio.php?op=mostrar",
    data: { idOrden: idOrden },
    dataType: "JSON",
    success: function (data) {
   console.log(data)
   nro_orden=data.nro_orden;
   razon_social=data.razon_social;
   $("#txt_celular").val(data.telefono)
    },
  });
}
function mostrarform(flag) {

fecha_actual()
  if (flag) {
    $("#listadoregistros").hide();
    $("#formularioregistros").show();
    $("#lbltitulo").text("NUEVO ORDEN DE SERVICIO  ");
    //$("#btnGuardar").prop("disabled",false);
    $("#btnagregar").hide();
    $("#btnCancelar").show();
  } else {
    $("#listadoregistros").show();
    $("#formularioregistros").hide();
    $("#lbltitulo").text("ORDEN DE SERVICIO  ");
    $("#btnagregar").show();
  }
  //limpiar();

 

}
$("#btn_enviar_ws").on("click",function(){
bloqueado=razon_social.replace(/ /g,"%20");
var url=window.location.origin;
console.log(bloqueado)
// window.open("https://www.demo.sichasoft.com/ajax/pdf_ticket/"+nro_orden+"-"+razon_social+".pdf")
 var link=url+"/ajax/pdf_ticket/"+nro_orden+"-"+bloqueado.toUpperCase()+".pdf"
console.log(link)
 //var url="https://wa.me/51910467736/?text=Hola, tengo una consulta. Enviado desde:"
 telefono=$("#txt_celular").val();
 
 window.open(" https://wa.me/51"+telefono+"?text=le enviamos tu orden" +" "+encodeURIComponent(link));

})


function mensaje(title,text,icon){
	Swal.fire({
  title: title,
  text: text,
  icon: icon
});
}
// funciones para el cambio de estado

init();
