var tabla;
var id_igv;
var nom_igv;

//Función que se ejecuta al inicio
function init(){


 // Sigue siendo el día de hoy, pero con la hora cambiada a 0.

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	$("#formulario_clientes").on("submit", function (e) {
    guardaryeditar_clientes(e);
  });
	//Cargamos los items al select cliente
	$.post("../ajax/nota_credito.php?op=tipo_ncredito", function (r) {
    $("#tipo_ncredito").html(r);
    $("#tipo_ncredito").selectpicker("refresh");
  });
  	$.post("../ajax/nota_credito.php?op=adjuntar_documento", function (r) {
    $("#serie_num").html(r);
    $("#serie_num").selectpicker("refresh");
  });
  
  	$.post("../ajax/nota_credito.php?op=selectDocumento", function (r) {
    $("#tipo_comprobante").html(r);
    $("#tipo_comprobante").selectpicker("refresh");
  });
  $.post("../ajax/nota_credito.php?op=selectDocumento_Nota", function (r) {
    $("#t_comprobante").html(r);
    $("#t_comprobante").selectpicker("refresh");
  });
  
 
    
	$('#mVentas').addClass("treeview active");
    $('#lNotaCerdito').addClass("active");

	//cobo tipo doc

	

  
fecha_actual();
  
}
function fecha_actual(){
 var now = new Date();
 var day = ("0" + now.getDate()).slice(-2);
 var month = ("0" + (now.getMonth() + 1)).slice(-2);
 var today = now.getFullYear() + "-" + month + "-" + day;
 
 $("#fecha_emision").val(today);
 $("#fecha_emision_nota").val(today);
}
function listar_igv(){
	 $.post("../ajax/venta.php?op=llenar_combo_igv2", function (r) {
     $(".tipo_igv").html(r);
   });
}
function listar_igv2(){
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
         $(".tipo_igv").append('<option value="'+data[i]["idigv"]+'">'+data[i]['igv']+'</option>');
        
      }

    },
    error: function (data) {
      console.log("ERROR " + data);
    },
  });
}
//Función limpiar
 function limpiar()
{
	document.getElementById("idcliente").value="";
  document.getElementById("nro_documento").value="";
  // limpiado los select
   $("#tipo_comprobante").val("Seleccione");
	$("#tipo_comprobante").selectpicker('refresh');

   $("#modo_pago").val("Seleccione");
	  $("#modo_pago").selectpicker("refresh");
  document.getElementById("serie_comprobante").value = "";
  document.getElementById("num_comprobante").value="";
 $(".filas").remove();
 document.getElementById("total_gravada").value="";
 document.getElementById("total_igv").value = "";
 document.getElementById("total_a_pagar").value = "";
 document.getElementById("n_op").value = "";
 document.getElementById("obs").value = "";

 
}


//Función mostrar formulario

//Función cancelarform
function cancelarform()
{
	limpiar();
    $(".mdlClientes").modal("hide");
    mostrarform(true);
}

//Función Listar


//Función ListarArticulos

// funcion para la opcion  seleccionar mode de pago








//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault();
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/nota_credito.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {  
        
         console.log(datos);
	    },
      error:function(d){
        console.log(d.responseText);
      }

	});

}



function sendSunat(id){
  //window.open("../ajax/pruebas.php?id=" + id + "&opc=enviar_sunat");
   $.ajax({
     url: "../ajax/enviar_sunat.php?id=" + id + "&opc=enviar_sunat",
     type: "GET",
     contentType: false,
     processData: false,

     success: function (resp) {
     datax = JSON.parse(resp)
     var mensaje = datax.data.respuesta_sunat_descripcion;
       console.log(mensaje);
        mensaje = JSON.stringify(mensaje);
      bootbox.alert(mensaje);
     },
   });
}
function ticket(id) {
  
  $("#cnt_1").attr(
    "src",
    "../ajax/enviar_sunat.php?id=" + id + "&opc=imprime_ticket"
  );
  $("#mdlPDF1").modal("show");
 
}
	




//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto=18;
var cont=0;
var detalles=0;
//$("#guardar").hide();

$("#tipo_comprobante").change(marcarImpuesto);
$("#t_comprobante").change(seleccionar_tcomprobante);


  

   


 



  // funciones de autocompletado
  
// autocompletar productos

$("#btn_buscar_venta").click(function () {
  console.log("ok")
  var serie = $("#serie_comprobante").val();
  var numero = $("#nro_serie").val();
  var filtro = {
    serie_comprobante: serie,
    nro_serie:numero,
  };
  
    $.ajax({
      type: "POST",
      url: "../ajax/nota_credito.php?op=obtener_venta_cabecera",
      data: filtro,
      success: function (data) {
        data=JSON.parse(data)
        $("#nombre_tipo_doc").val(data[0].nombre_tipo_doc);
        $("#serie_comprobante_1").val(data[0].serie);
        $("#numero_serie").val(data[0].numero);
        $("#fecha_venc").val(data[0].fecha_emision_sf);
         $("#idcliente").val(data[0].idcliente);
        $("#nro_documento").val(data[0].num_documento);
        $("#razon_social").val(data[0].razon_social);
        $("#direccion").val(data[0].direccion);
        $("#sub_total").val(data[0].total_gravada);
        $("#igv").val(data[0].total_igv);
        $("#total").val(data[0].total_venta);
       obtener_detalle(serie,numero)
        
      },
      error: function (d) {
        console.log(d.responseText);
      },
    });
  

});
function obtener_detalle(serie_v, numero_v){
console.log("serie OBTENIDA " +serie_v + " "+"NUMERO OBTENIDO " +numero_v)
  

  
   $.ajax({
     type: "POST",
     url: "../ajax/nota_credito.php?op=obtener_venta_detalle",
     data: { serie_comprobante: serie_v, nro_serie: numero_v },
     success: function (data) {
       data=JSON.parse(data);
       limpiarBody();

       for(var i=0;i<data.length;i++){
        
        console.log(data[i].nombre_producto)
        var nueva_fila =
          '<tr class="filas" id="fila' +
          cont +
          '">' +
          '<td><input type="hidden" name="idarticulo[]" value="' +
          data[i].idarticulo +
          '">' +
          data[i].nombre_producto +
          "</td>" +
          '<td  style="width:0px"><input type="text" class="form-control" name="cantidad[]" id="cantidad" value="' +
          data[i].cantidad +
          '"readonly style="width:50px"></td>' +
          '<td style="width:5px"><input type="text" class="form-control" name="precio_venta[]" id="cantidad" value="' +
          data[i].precio_venta +
          '"readonly style="width:50px"></td>' +
          '<td  style="width:5px"><input type="text" class="form-control" name="imp_total[]" id="cantidad" value="' +
          data[i].total +
          '" readonly style="width:50px"></td>' +
          "</tr>";
        cont++;
        $("#detalles").append(nueva_fila);
       }
       
     },
     error: function (d) {
       console.log(d.responseText);
     },
   });
}
function limpiarBody() {
  document.getElementById("detalles").querySelector("tbody").innerHTML = "";
  $("#t_comprobante").val(0);
  $("#t_comprobante").selectpicker('refresh');

  $("#serie_nota").val("");
  $("#numero_nota").val("");


}
// guardar y editar clientes



function imprimir(id){
  
       // alert('ok');

  $("#contenedor_pdf").attr( "src","../ajax/enviar_sunat.php?id=" + id + "&opc=imprime_pdf");
  $("#mdlPDF").modal("show");
}
      
function seleccionar_tcomprobante()
  {
  	 var nombre = $("#t_comprobante option:selected").text();
     var serie_comprobante = $("#serie_comprobante").val();
     console.log(nombre);
     $.post(
       "../ajax/venta.php?op=obtener_serie_num",
       {
         nombre: nombre,
       },
       function (data, status) {
         resa = JSON.parse(data);
         console.log("SERIE OBET", resa);

         var mayorAsNumbera = resa === null ? 1 : Number(resa.numero) + 1;

         if (resa === null) {
           nuevoSerie = nombre;
           
            if (nombre == "NOTA DE CREDITO" && serie_comprobante=="BBB1") {
              nuevoSerie = "BBC1";
            }else if(nombre == "NOTA DE CREDITO" && serie_comprobante=="FFF1"){
              nuevoSerie = "FFC1";
            }else{
              console.log("ocurrio un error")
            }
         } else {
           nuevoSerie = resa.serie;
         }
         var nuevoNumero = mayorAsNumbera.toString().padStart(7, 0);
         $("#serie_nota").val(nuevoSerie);
         $("#numero_nota").val(nuevoNumero);
       }
     );


  }



// funcion para obtener ventas






// funcion para extraer caracteres
$("#imprimir_pdf").on("click",function(){
  id_venta = $("#idventa").val();
  imprimir(id_venta);
  $("#mdlPDF1").modal("hide");
});
$("#modal_guia").on("click",function(){
  $("#mdlPDF1").modal("hide");
  $("#mdlGuias").modal("show");
});

function marcarImpuesto() {
  var tipo_comprobante = $("#tipo_comprobante option:selected").val();
  console.log("comprobate", tipo_comprobante);
  var nombre = $("#tipo_comprobante option:selected").text();
  console.log(nombre);
  $.post(
    "../ajax/venta.php?op=obtener_serie_num",
    {
      nombre: nombre,
    },
    function (data, status) {
      resa = JSON.parse(data);
      console.log("SERIE OBET", resa);

      if (resa === null) {
        nuevoSerie = nombre;
        if (nombre == "FACTURA") {
          nuevoSerie = "FFF1";
        } else if (nombre == "BOLETA") {
          nuevoSerie = "BBB1";
        } else if (nombre == "PROFORMA") {
          nuevoSerie = "PPP1";
        } else if (nombre == "NOTA DE CREDITO") {
          nuevoSerie = "BBC1";
        }
      } else {
        nuevoSerie = resa.serie;
      }

      $("#serie_comprobante").val(nuevoSerie);
     
    }
  );
}


init();