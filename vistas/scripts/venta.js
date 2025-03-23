var tabla;
var id_igv;
var nom_igv;

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

total_dia()
 //
 // Sigue siendo el día de hoy, pero con la hora cambiada a 0.



	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});


	//Cargamos los items al select cliente
	$.post("../ajax/venta.php?op=selectDocumento", function (r) {
    $("#tipo_comprobante").html(r);
    $("#tipo_comprobante").selectpicker("refresh");
  });
	$('#mVentas').addClass("treeview active");
    $('#lVentas').addClass("active");

	//cobo tipo doc

		$.post("../ajax/cliente.php?op=select_tipo_doc", function (r) {
      $("#idTipoDoc").html(r);
      $("#idTipoDoc").selectpicker("refresh");
    });
	$.post("../ajax/venta.php?op=llenar_combo_tipo_ope", function (r) {
    $("#tipo_ope").html(r);
    $("#tipo_ope").selectpicker("refresh");
  });
  $.post("../ajax/venta.php?op=llenar_combo_monedas", function (r) {
    $("#id_moneda").html(r);
    $("#id_moneda").selectpicker("refresh");
  });
   $.post("../ajax/venta.php?op=modo_pago", function (r) {
    console.log(r)
     $("#modo_pago").html(r);
     $("#modo_pago").selectpicker("refresh");
   });


  
fecha_actual();
  ocultar_elementos();
}
function fecha_actual(){
 var now = new Date();
 var day = ("0" + now.getDate()).slice(-2);
 var month = ("0" + (now.getMonth() + 1)).slice(-2);
 var today = now.getFullYear() + "-" + month + "-" + day;
 
 $("#fecha_emision").val(today);
 $("#fecha_venc").val(today);
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
   $("#tipo_comprobante").val("SELECCIONE");
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
function mostrarform(flag)
{
	//limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#lbltitulo").text( "INGRESE LOS DATOS DEL COMPROBANTE  ");
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
    $("#btn_imprimir").hide();
		

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").show();
   

		detalles=0;
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
			$("#lbltitulo").text("LISTA DE VENTAS  ");
		$("#btnagregar").show();
      $("#btn_imprimir").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
  
    mostrarform(false);
}

//Función Listar


$("#btn_cerrarModal").on("click",function(){
  $(".mdlClientes").modal("hide");
  limpiar_clientes();

});

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
		   url: '../ajax/venta.php?op=listar',
					   type : "get",
					   dataType : "json",						
					   error: function(e){
						   console.log(e.responseText);	
					   }
	   },
	 
	 });
}


//Función ListarArticulos

// funcion para la opcion  seleccionar mode de pago





  
// funcion para obtener numero y serie
  $(document).on("change",".tipo_igv",function(){
       var opc=$(".tipo_igv").val();
      if(opc==1){
        calcular_totales();
      }else
      {
          if (opc == 2) {
           var tot = document.getElementsByName("total[]");
           var total = 0.0;

           for (var i = 0; i < tot.length; i++) {
             total += parseFloat(document.getElementsByName("total[]")[i].value);
           }
          
           $("#total_gratuita").val(total);
          }else{
            calcularTotales();
          }
      } 
  
     })


//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault();
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/venta.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {  
        
         console.log(datos);
          //sendSunat(0);
          imprimir(0); 
     
       // sendSunat(0);
     
        
              
           //          
	           mostrarform(false);
	          listar();
            total_dia(); 
            limpiar();
	    }

	});

}

function mostrar(id)
{
  //window.open("../ajax/pruebas.php?id="+id)
   $("#cnt_1").attr("src","../ajax/enviar_sunat.php?id=" + id + "&opc=imprime_ticket"
   );
 
  $("#idventa").val(id);
  console.log("id venta"+id)
  $("#mdlPDF1").modal("show");
  
}


function sendSunat(id){


  base_url = "../ajax/enviar_sunat.php?id=" + id + "&opc=enviar_sunat";
$.getJSON(base_url).done(function (data1) {

  datosJson=JSON.parse(data1)
  console.log(datosJson);
  //console.log(datosJson.data.respuesta_sunat_descripcion);
 

 mensaje("Respuesta de Sunat: "+datosJson.data.respuesta_sunat_descripcion,"Codigo de Respuesta: "+datosJson.data.respuesta_sunat_codigo,'success')
 
  var datos_act={
  	idventa:id,
  	estado_venta:"Aceptado",
  	estado_ope:datosJson.data.respuesta_sunat_codigo,
  	respuesta_sunat:datosJson.data.respuesta_sunat_descripcion
  }
    console.log(datos_act);
  	$.post("../ajax/venta.php?op=enviar_documento", datos_act, function(e){
        	//	bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        	
});

}
function ticket(id) {
  
  $("#cnt_1").attr(
    "src",
    "../ajax/enviar_sunat.php?id=" + id + "&opc=imprime_ticket"
  );
  $("#mdlPDF1").modal("show");
  /*    $.ajax({
     url: "../ajax/envio_sunat.php?id=" + id + "&opc=anular",
     type: "GET",
     contentType: false,
     processData: false,

     success: function (resp) {
       datax = JSON.parse(resp);
       console.log(datax);
     },
   }); */
  /* var ruta_xml="../ajax/envio_sunat.php?id=" + id + "&opc=anular";
  $.getJSON(ruta_xml)
  .done(function(data){
    ruta_envio_baja ="http://localhost/sichasoft/ws_sunat/index.php?numero_documento=" +data.numero_documento +"&cod_1=" +data.cod_1 +"&cod_2=" +data.cod_2 + "&cod_3=" +data.cod_3 +"&cod_4=" +data.cod_4 +"&cod_5=" + data.cod_5 +"&cod_6=" + data.cod_6 + "&cod_7=" + data.cod_7;
   console.log(ruta_envio_baja);
   $.getJSON(ruta_envio_baja)
   .done(function(data_ticket){
    console.log(data_ticket);
    console.log(data_ticket.ticket[0]);
   })

   
  }) */
}
	




//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto=18;
var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto()
  {
  	var tipo_comprobante = $("#tipo_comprobante option:selected").val();
  	 console.log("comprobate", tipo_comprobante);
  	  $.post("../ajax/venta.php?op=obtener_series_numero",{tipo_comprobante: tipo_comprobante},
       function (data, status) {
       	resa = JSON.parse(data);
       	console.log(resa);
           $("#serie_comprobante").val(resa.num_serie);
          
          var serie=resa.num_serie;
          console.log(serie);
        obtener_generar_correlativo(serie);
       });
      
  
    
  /*	
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

         var mayorAsNumbera = resa === null ? 1 : Number(resa.numero) + 1;

         if (resa === null) {
           nuevoSerie = nombre;
           if (nombre == "FACTURA") {
             nuevoSerie = "FFF1";
           } else if (nombre == "BOLETA") {
             nuevoSerie = "BBB1";
           } else if (nombre == "PROFORMA") {
             nuevoSerie = "PPP1";
           } else if (nombre == "NOTA CREDITO") {
             nuevoSerie = "BBC1";
           }
         } else {
           nuevoSerie = resa.serie;
         }
         var nuevoNumero = mayorAsNumbera.toString().padStart(7, 0);
         //var serie = res.MENSAJE.substring(0,4);
         //var numeracion = res.MENSAJE.substring(5, 12);
         //console.log(serie);
         //console.log(numeracion);
         $("#serie_comprobante").val(nuevoSerie);
         $("#num_comprobante").val(nuevoNumero);
       }
     );
*/

  }
  function obtener_generar_correlativo(serie_comprobante){
  	console.log("metodod_generar "+serie_comprobante);
	 $.post("../ajax/venta.php?op=obtener_correlativo_venta",{serie_comprobante: serie_comprobante},
       function (data, status) {
       	console.log(data);
       	numeracion = JSON.parse(data);
	$("#num_comprobante").val(numeracion.nuevo_numero_factura);
       
       });
  
}
  

function agregarDetalle(idarticulo,articulo,precio_venta){
  	var cantidad=1;
    if (idarticulo!="")
    {
    	var subtotal=cantidad*precio_venta;
		listar_igv();
    	var fila =
        '<tr class="filas" id="fila' +
        cont +
        '">' +
        '<td><input type="text" class="form-control" name="cantidad[]" id="cantidad" value="' +
        cantidad +
        '"></td>' +
        '<td><input type="hidden" name="idarticulo[]" value="' +
        idarticulo +
        '">' +
        articulo +
        "</td>" +
        
        '<td><input type="text" class="form-control" name="precio_venta[]" id="precio_venta"  value="' +
        precio_venta +
        '"></td>' +
        '<td><input type="text"class="form-control" name="total[]" id="total[]" value="' +
        subtotal +
        '"></td>' +
        '<td><div class="form-group"><button type="button" class="btn btn-danger" onclick="eliminarDetalle(' +
        cont +
        ')"><i class="fa fa-trash" aria-hidden="true"></i></button></div> </td>' +
        "</tr>";
    	cont++;
    	detalles=detalles+1;
    	$('#detalles').append(fila);
    	calcular_totales();
		
    }
    else
    {
    	alert("Error al ingresar el detalle, revisar los datos del artículo");
    }
  }
    $(document).on("keyup", "#cantidad", function () {
      calcular_totales();
    });
     $(document).on("keyup", "#precio_venta", function () {
       calcular_totales();
     });

   
function ocultar_elementos(){


  $("#div_descuento_global").hide();
  $("#div_total_gravada").show();
  $("#div_total_inafecta").hide();
  $("#div_total_exonerada").hide();
  $("#div_total_igv").show();
  $("#div_total_gratuita").show();
  $("#div_total_bolsa").hide();
  $("#div_PrepaidAmount").hide();
  $("#div_total_a_pagar").show();
  $("#div_total_exportacion").hide();
}

  function calcular_totales()
  {
  	var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_venta[]");
    var tot = document.getElementsByName("total[]");

    for (var i = 0; i <cant.length; i++) {
    	var cantidad=cant[i];
    	var precio=prec[i];
    	var total=tot[i];
  
    	total.value=(cantidad.value * precio.value);
     // console.log("total gravad" + " "+ total.value)
    	document.getElementsByName("total[]")[i].value = total.value;
    }
   calcularTotales();

  }
  function calcularTotales(){
  	var tot = document.getElementsByName("total[]");
  	var total = 0.0;

  	for (var i = 0; i <tot.length; i++) {
		total +=parseFloat(document.getElementsByName("total[]")[i].value) / 1.18;
	}


    $("#total_gravada").val(total.toFixed(2));
    // calculamos el igv y el totala a pagar
    var igv=0.18
    var tipo_comprobante = $("#tipo_comprobante option:selected").val();
    
  var valor_igv= total*igv;
  $("#total_igv").val(valor_igv.toFixed(2));
  var valor_total_pagar=total+valor_igv;
    $("#total_a_pagar").val(valor_total_pagar.toFixed(2));
    total_a_pagar = parseFloat(total_gravada)+parseFloat( igv);
    
    /* var gravada=total;
    var valor_igv=total*0.18;
    var total_a_pagar=total+valor_igv;
    console.log("total gravada : " + gravada);
    console.log("Igv : " + valor_igv);
    console.log("total pagar : " + total_a_pagar);
 */



    evaluar();
  }



  function evaluar(){
  	if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide(); 
      cont=0;
    }
  }

  function eliminarDetalle(indice){
  	$("#fila" + indice).remove();
  	calcularTotales();
  	detalles=detalles-1;
  	evaluar()
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
      console.log(ui.item.idc);
    },
  });
// autocompletar productos
$("#cod_prod").autocomplete({
  source: function (request, response) {
    $.ajax({
      url: "../ajax/venta.php?op=autocomplete_producto",
      type: "GET",
      dataType: "JSON",
      success: function (data) {
        console.log(data);
        aData = $.map(data, function (value, key) {
          return {
            label: value.codigo_producto + "-" + value.nombre_producto+" STOCK= "+value.stock,
            idp: value.idarticulo,
            nombre_prod:value.nombre_producto,
            stk_prod:value.stock,
            precio_prod:value.precio_base_venta,
          };
        });
        var result = $.ui.autocomplete.filter(aData, request.term);
        response(result);
      },
    });
  },
  select: function (event, ui) {
	console.log("precio"+ui.item.precio_prod);

  agregarDetalle(ui.item.idp,ui.item.nombre_prod,ui.item.precio_prod);
setTimeout(function () {
  $("#cod_prod").val("");
}, 500);
   
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
// guardar y editar clientes

$( "#btnGuardar_cl" ).on( "click", function(event) {
	event.preventDefault();
 var formData = new FormData($("#for_clientes")[0]);
console.log(formData);
  $.ajax({
    url: "../ajax/cliente.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
      mensaje(datos,"","success");
	  var num_doc = $("#nro_doc").val();
	  obtener_cliente(num_doc);
      $(".mdlClientes").modal("hide");
      
	limpiar_clientes();
    },
  });
  ;
  
} );
function limpiar_clientes() {
$("#idcliente").val("");
$("#nro_doc").val("");
$("#razon_social").val("");
$("#direccion").val("");
$("#telefono").val("");
$("#estado_sunat").val("");
}


function obtener_cliente(nro_doc){
	$.post("../ajax/venta.php?op=obtener_cliente",{nro_doc : nro_doc}, function(data, status)
	{
		console.log("num_doc.." + nro_doc);
		data = JSON.parse(data);
		console.log(data);
		$("#idcliente").val(data.idcliente);
		$("#nro_documento").val(data.num_documento + "-" + data.razon_social);
		console.log(data.num_documento + "-" + data.razon_social);
		
	})
}

// obtenemos los registros para la creacion del xml

    
     /* for (var i = 0; i < data.empresa.length; i++) {
        console.log(data.empresa[i][0].nom_empresa)
          jsonStr=JSON.stringify(data.empresa[i][0].ruc);
          console.log(jsonStr);
          
      }
*/

   




     
  
 
 
 // window.location.href = "../xml/ticket_boleta.php";
 


function obtener_id_venta(){
 
  	$.post(
      "../ajax/venta.php?op=obtener_id_venta",
      function (data, status) {
        //console.log("num_doc.." + nro_doc);
        data = JSON.parse(data);
        $("#venta_id").val(data.id);
       // console.log(data.id);
       
      }
    );
}
function total_dia(){
  $.post("../ajax/venta.php?op=total_dia", function (data, status) {
    //console.log("num_doc.." + nro_doc);
    data = JSON.parse(data);
    console.log(data);
  var filas=data.length;
  for(i=0;i<filas;i++){
    var nueva_fila =
      '<tr class="filas" id="fila' +
      cont +
      '">' +
      '<td>'+data[i].modo_pago_desc+'</td>'+
      '<td>'+ data[i].total+'</td>';
      "</tr>";
    cont++;
  
   $("#tabla_resultados").append(nueva_fila);
  }
    // console.log(data.id);
  });
}
// funcion para extraer caracteres
$("#imprimir_pdf").on("click",function(){
  id_venta = $("#idventa").val();
  imprimir_pdf_a4(id_venta);
  $("#mdlPDF1").modal("hide");
});
$("#modal_guia").on("click",function(){
  $("#mdlPDF1").modal("hide");
  $("#mdlGuias").modal("show");
});

// funcion pra enviar a sunat

function enviar_sunat(idventa)
{
Swal.fire({
  title: "¿Está Seguro de enviar este documento a sunat ?",
  text: "",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si"
}).then((result) => {
  if (result.isConfirmed) {
  	sendSunat(idventa);
  	
   
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

function imprimir(id){
    // alert('ok');
 //window.open("../ajax/enviar_sunat.php?id=" + id + "&opc=imprime_pdf");
  $("#contenedor_pdf").attr( "src","../ajax/enviar_sunat.php?id=" + id + "&opc=imprime_ticket");
 
  $("#mdlPDF").modal("show");
}
function imprimir_pdf_a4(id){
    // alert('ok');
 //window.open("../ajax/enviar_sunat.php?id=" + id + "&opc=imprime_pdf");
  $("#contenedor_pdf").attr( "src","https://www.demo.sichasoft.com/api/API_SUNAT/files/facturacion_electronica/PDF/10476611666-03-BBB1-0000017.pdf");
 
  $("#mdlPDF").modal("show");
}




init();