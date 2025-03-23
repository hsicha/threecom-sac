var tabla;
var nro_orden;
var razon_social;



//Función que se ejecuta al inicio
function init() {
  $("form").keypress(function (e) {
    var key;
    if (window.event) key = window.event.keyCode; //IE
    else key = e.which; //firefox
    return key != 13;
  });
  listar();
	$("#fecha").change(listar);
  $.post("../ajax/equipos.php?op=select_marca", function (r) {
    $("#marca").html(r);
    $("#marca").selectpicker("refresh");
    
  });
  $.post("../ajax/cliente.php?op=select_tipo_doc", function (r) {
    $("#idTipoDoc").html(r);
    $("#idTipoDoc").selectpicker("refresh");
    
  });


  //

  // Sigue siendo el día de hoy, pero con la hora cambiada a 0.

  mostrarform(false);
//  listar();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });

  $("#formulario_clientes").on("submit", function (e) {
    guardaryeditar_clientes(e);
  });
  //Cargamos los items al select cliente
  $.post("../ajax/orden_servicio.php?op=select_area", function (r) {
    $("#cbo_situacion").html(r);
    $("#cbo_situacion").selectpicker("refresh");
  }); 
   $.post("../ajax/orden_servicio.php?op=select_estado_orden", function (r) {
     $("#id_estado").html(r);
     $("#id_estado").selectpicker("refresh");
     
   });
    $.post("../ajax/orden_servicio.php?op=select_tipo_equipo", function (r) {
     $("#cbo_tipo_eq").html(r);
     $("#cbo_tipo_eq").selectpicker("refresh");
     
   });

  $("#mOrden").addClass("treeview active");
  $("#lOrden").addClass("active");

  //cobo tipo doc
}
function fecha_actual() {
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear() + "-" + month + "-" + day;

  $("#fecha_ingreso").val(today);
  $("#fecha_entrega").val(today);
  $("#fecha").val(today);
  
}
function listar_igv() {
  $.post("../ajax/venta.php?op=llenar_combo_igv2", function (r) {
    $(".tipo_igv").html(r);
  });
}
function listar_igv2() {
  $.ajax({
    url: "../ajax/venta.php?op=llernar_combo_igv",
    type: "GET",
    dataType: "JSON",
    dataSrc: "",
    success: function (data) {
      for (i = 0; i < data.length; i++) {
        console.log(data[i]);
        id_igv = data[i]["idigv"];
        nom_igv = data[i]["igv"];
        $(".tipo_igv").append(
          '<option value="' +
            data[i]["idigv"] +
            '">' +
            data[i]["igv"] +
            "</option>"
        );
      }
    },
    error: function (data) {
      console.log("ERROR " + data);
    },
  });
}
//Función limpiar

//Función mostrar formulario
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

$("#btnCancelar").on("click", function () {
  limpiar();
  $("#listadoregistros").show();
  $("#formularioregistros").hide();
  $("#btnagregar").show();
  listar();
});
//Función cancelarform
function cancelarform() {
  limpiar();
  $(".mdlClientes").modal("hide");
  mostrarform(true);
}

//Función Listar

function listar() {
	
	var fecha_buscar= $("#fecha").val();
	console.log(fecha_buscar)
 tabla = $("#tbllistado").DataTable({
 	lengthMenu: [ 100, 150, 200, 250, 300],//mostramos el menú de registros a revisar
		bLengthChange: true,
		autoWidth: false,
		 bDestroy: true,
		 order: [
        [0, 'asc']    ],
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
		   url: '../ajax/orden_servicio.php?op=listar',
		   data:{fecha:fecha_buscar},
					   type : "get",
					   dataType : "json",						
					   error: function(e){
					   	console.log(e);
						   console.log(e.responseText);	
					   }
	   },
	 
	 });
	
	
	/*
  tabla = $("#tbllistado").dataTable({
    responsive: true,
    bLengthChange: true,
    bDestroy: true,
    language: {
      search: "Buscar por",
      lengthMenu: "Mostrar _MENU_ Elementos",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Elementos",
      infoEmpty: "Mostrando 0 registros de 0 registros encontrados",
      paginate: {
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    columnDefs: [{ visible: false }],
    searching: true,
    ajax: {
      url: "../ajax/orden_servicio.php?op=listar",
      type: "POST",
      success: function(datos)
	    {  
        
         console.log("dat", datos);
	    },
      error: function(e){
			console.log(e.responseText);	
		}
    },
    columns: [
      { data: "fecha_ingreso" },
      { data: "nro_orden" },
      { data: "cliente" },
      { data: "equipo" },
      { data: "falla_equipo" },
      { data: "accesorios" },
      { data: "costo_total" },
      { data: "adelanto" },
      { data: "diferencia" },
      { data: "acciones" },
    ],
  }).DataTable();
  */
  
  
}

//Función ListarArticulos

// funcion para la opcion  seleccionar mode de pago

function Numeracion() {
  $.post(
    "../ajax/orden_servicio.php?op=nro_orden",
    function (res, status) {
      res = JSON.parse(res);
      var mayorAsNumbera = res === null ? 1 : Number(res.nro_orden) + 1;
      var nuevoNumero = mayorAsNumbera.toString().padStart(7, 0);
      $("#num_orden").val(nuevoNumero);
      console.log(nuevoNumero);
      
    }

    
  );
}

// funciones de autocompletado
$("#nro_documento").autocomplete({
  source: function (request, response) {
    $.ajax({
      url: "../ajax/venta.php?op=autocompleteCliente",
      type: "GET",
      dataType: "JSON",
      success: function (data) {
        console.log(data);
        aData = $.map(data, function (value, key) {
          return {
            label: value.num_documento + "-" + value.razon_social,
            idc: value.idcliente,
          };
        });
        var result = $.ui.autocomplete.filter(aData, request.term);
        response(result);
      },
    });
  },
  select: function (event, ui) {
    $("#idcliente").val(ui.item.idc);
    Numeracion();
    fecha_actual();
    console.log(ui.item.idc);
  },
});
// autocompletar productos
$("#marca").autocomplete({
  source: function (request, response) {
    $.ajax({
      url: "../ajax/orden_servicio.php?op=autocomplete_Marca",
      type: "GET",
      dataType: "JSON",
      success: function (data) {
        console.log(data);
        aData = $.map(data, function (value, key) {
          return {
            label:
              value.nombre,
            idmarca: value.idMarca,
            nombre_marca: value.equipo,
         
          };
        });
        var result = $.ui.autocomplete.filter(aData, request.term);
        response(result);
        console.log(result);
      },
    });
  },
  select: function (event, ui) {
    console.log(ui.item.idmarca);
    $("#idmarca").val(ui.item.idmarca);
  },
});
$("#btn_buscar_ruc_dni").click(function () {
  var dni = $("#nro_documento").val();
  if (dni.length == 8) {
    $.ajax({
      type: "POST",
      url: "../ajax/consultaDni.php",
      data: "dni=" + dni,
      dataType: "json",
      success: function (data) {
        console.log(data);
        if (data.numeroDocumento == dni) {
          $("#idTipoDoc").val(data.tipoDocumento);
          $("#idTipoDoc").selectpicker("refresh");
          $("#nro_doc").val(data.numeroDocumento);
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
          $("#nro_doc").val(data.numeroDocumento);
          $("#razon_social").val(data.nombre);
          $("#direccion").val(data.direccion);
          $("#estado_sunat").val(data.estado);
          console.log(data);
        }
      },
    });
  }
  $(".mdlClientes").modal("show");
});
$("#btn_busscar_marca").click(function () {
  $(".mdlMarca").modal("show");
});

$("#btnGuardar_Marca").click(function (e) {
  e.preventDefault();
  var formData = new FormData($("#formulario_Marca")[0]);

  $.ajax({
    url: "../ajax/marca.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      $(".mdlMarca").modal("hide");
      obtenerMarca();
      mostrarform(true);
    },
  });

});
// guardar y editar clientes
function guardaryeditar_clientes(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  //$("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario_clientes")[0]);
  console.log(formData);
  $.ajax({
    url: "../ajax/cliente.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
    	
      mensaje(datos,"","success")
      var num_doc = $("#nro_doc").val();
      obtener_cliente(num_doc);
      Numeracion();
      cancelarform();
    },
  });
  limpiar();
}
function obtener_cliente(nro_doc) {
  $.post(
    "../ajax/venta.php?op=obtener_cliente",
    { nro_doc: nro_doc },
    function (data, status) {
      console.log("num_doc.." + nro_doc);
      data = JSON.parse(data);
      console.log(data);
      $("#idcliente").val(data.idcliente);
      $("#nro_documento").val(data.num_documento + "-" + data.razon_social);
      console.log(data.num_documento + "-" + data.razon_social);
    }
  );
}

$("#btnGuardar").on("click", function (e) {
  e.preventDefault();
  var formData = new FormData($("#formulario_orden")[0]);
  var idOrden= $("#idOrden").val();
  console.log("id orden actual " + idOrden);
  $.ajax({
    type: "POST",
    url: "../ajax/orden_servicio.php?op=guardaryeditar",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
    mensaje(data,"success")
    
    if(idOrden==''){
    	imprimir_tick(0)
    }else{
    	imprimir_tick(idOrden)
    }
      
        listar();
		limpiar();
    },
    error: function (data) {
      console.log(data.responseText);
       mensaje(data,"","error")
    },
  });


  /* var id_ord=$("#idOrden").val();
  if(id_ord==""){
  imprimir_tick(0)
 }else{
  imprimir_tick(id_ord);
 }
 */
  $("#listadoregistros").show();
  $("#formularioregistros").hide();
  $("#btnagregar").show();
});

function abrirModal(flag) {
  if (flag) {

    $(".myModal").modal("show");
  } else {
    $(".myModal").modal("hide");
 
  }
}


function obtenerMarca() {
  $.ajax({
    url: "../ajax/orden_servicio.php?op=obtener_Marca",
    type: "GET",
    dataSrc: "",
    success: function (data) {
      data = JSON.parse(data);
      $("#idmarca").val(data.idMarca);
      $("#marca").val(
        data.nombre
      );
    },
    error: function (data) {
      console.log(data.responseText);
    },
  });
  
}
function mostrar_detalle(idOrden){
   
  $.ajax({
    type: "POST",
    url: "../ajax/orden_servicio.php?op=mostrar",
    data: { idOrden: idOrden },
    dataType: "JSON",
    success: function (data) {
   console.log(data)
     $("#idOrden").val(data.idOrden)
     $("#idcliente").val(data.idcliente)
     $("#nro_documento").val(data.razon_social);
     $("#cbo_situacion").val(data.idArea);
     $("#cbo_situacion").selectpicker("refresh");
     $("#fecha_ingreso").val(data.fechaIngreso)
     $("#num_orden").val(data.nro_orden)
     $("#idmarca").val(data.idMarca);
     $("#marca").val(data.marca);
     $("#modelo").val(data.modelo);
     $("#accesorios").val(data.accesorios);
     $("#costo_total").val(data.costo_total)
     $("#adelanto").val(data.adelanto)
     $("#diferencia").val(data.diferencia)
     $("#id_estado").val(data.id_estado);
     $("#id_estado").selectpicker("refresh");
     $("#idequipo").val(data.idequipo)
     $("#det_equipo").val(data.equipo);
     $("#falla_equipo").val(data.falla_equipo);
     $("#cbo_tipo_eq").val(data.id_tipoEquipo);
     $("#cbo_tipo_eq").selectpicker("refresh");
     $("#observacion").val(data.observaciones);
    },
  });
  mostrarform(true);

}
    $(document).on("keyup", "#adelanto", function () {
      calcular_totales();
    });
// funcion para extraer caracteres
 function calcular_totales(){
  var costo_cliente=document.getElementById("costo_total");
  var adelanto=document.getElementById("adelanto");
  var diferencia=parseFloat(costo_cliente.value-adelanto.value).toFixed(2);
  $("#diferencia").val(diferencia);
 }
 function limpiar (){
  $("#idOrden").val("");
  $("#idcliente").val("");
  $("#nro_documento").val("");
  $("#tipo_comprobante").val(0);
  $("#tipo_comprobante").selectpicker("refresh");
  fecha_actual()
  $("#idmarca").val("");
  $("#marca").val("");
  $("#num_orden").val("");
  $("#costo_total").val("");
  $("#adelanto").val("");
  $("#diferencia").val("");
  $("#idequipo").val("");
  $("#equipo").val("");
  $("#det_equipo").val("");
   $("#modelo").val("");
   $("#accesorios").val("");
   $("#falla_equipo").val("");
   $("#observacion").val("");
 }

 
function imprimir_tick(id) {
	
	
	
 // window.open("../ajax/pdf_ticket/0000010-SICHA ROMANI HERNAN.pdf")
  $("#cnt_1").attr("src", "../ajax/pdf_ticke_orden.php?id=" + id + "&opc=imprime_ticket");
	
  
  $("#mdlPDF1").modal("show");
}
function mensaje(title,text,icon){
	Swal.fire({
  title: title,
  text: text,
  icon: icon
});
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
init();
