var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
		$("#formularioProveedor").on("submit", function (e) {
      guardaryeditarProv(e);
    });
	//Cargamos los items al select proveedor
	$.post("../ajax/ingreso.php?op=selectTipoDoc", function (r) {
    $("#idTipoDoc").html(r);
    $("#idTipoDoc").selectpicker("refresh");
  });
	$('#mCompras').addClass("treeview active");
    $('#lIngresos').addClass("active");	

	fecha_actual();
}

//Función limpiar
function limpiar()
{
	$("#idproveedor").val("");
  $("#nro_documento").val("");
	$("#proveedor").val("");
	$("#serie_comprobante").val("");
	$("#num_comprobante").val("");
	 $(".filas").remove();
	$("#total_compra").val("");
	$(".filas").remove();
	$("#total").html("0");
	
	//Obtenemos la fecha actual
  fecha_actual();

    //Marcamos el primer tipo_documento
    $("#tipo_comprobante").val("Boleta");
	$("#tipo_comprobante").selectpicker('refresh');
}

function fecha_actual(){
	var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear() + "-" + month + "-" + day;
  $("#fecha_hora").val(today);
}
//Función mostrar formulario
function mostrarform(flag)
{
	//limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarArt").show();
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
function cerrarForm(){
	$(".mdlProveedores").modal('hide');
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
	bLengthChange: true,
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
      columnDefs: [{ visible: false }],
      responsive: true,
      searching: true,
      "ajax":{
        url: '../ajax/ingreso.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
    },
	}).DataTable();
}



//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ingreso.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          mensaje(datos,"","success");
	         console.log(datos);
	          mostrarform(false);
	          listar();
	    },
	    error:function(datos){
	    	 console.log(datos);	 
	    }

	});
	limpiar();
}

function mostrar(idingreso)
{
	$.post("../ajax/ingreso.php?op=mostrar",{idingreso : idingreso}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idproveedor").val(data.idproveedor);
		$("#idproveedor").selectpicker('refresh');
		$("#tipo_comprobante").val(data.tipo_comprobante);
		$("#tipo_comprobante").selectpicker('refresh');
		$("#serie_comprobante").val(data.serie_comprobante);
		$("#num_comprobante").val(data.num_comprobante);
		$("#fecha_hora").val(data.fecha);
		$("#impuesto").val(data.impuesto);
		$("#idingreso").val(data.idingreso);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
 	});

 	$.post("../ajax/ingreso.php?op=listarDetalle&id="+idingreso,function(r){
	        $("#detalles").html(r);
	});
}

//Función para anular registros
function anular(idingreso)
{
	bootbox.confirm("¿Está Seguro de anular el ingreso?", function(result){
		if(result)
        {
        	$.post("../ajax/ingreso.php?op=anular", {idingreso : idingreso}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
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
  	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
  	if (tipo_comprobante=='Factura')
    {
        $("#impuesto").val(impuesto); 
    }
    else
    {
        $("#impuesto").val("0"); 
    }
  }

function agregarDetalle(idarticulo,articulo,precio_venta)
  {
  	var cantidad=1;
    if (idarticulo!="")
    {
    	var subtotal=cantidad*precio_venta;
	//	listar_igv();
    	var fila =
        '<tr class="filas" id="fila' +
        cont +
        '">' +
        '<td><input type="hidden" name="idarticulo[]" value="' +
        idarticulo +
        '">' +
        articulo +
        "</td>" +
        '<td><input type="number" class="form-control" name="cantidad[]" id="cantidad" value="' +
        cantidad +
        '"></td>' +
        '<td><input type="text" class="form-control" name="precio_venta[]" id="precio_venta"  value="' +
        precio_venta +
        '"></td>' +
        '<td><input type="text"class="form-control" name="total[]" id="total[]" value="' +
        subtotal +
        '"></td>' +
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle(' +
        cont +
        ')">X</button></td>' +
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
  	evaluar();
  }
  // busqueda de documentos en reniec o sunat
$("#btn_buscar_ruc_dni").click(function () {
  var dni = $("#nro_documento").val();
if(dni.length==8){
$.ajax({
  type: "POST",
  url: "../ajax/consultaDni.php",
  data: "dni=" + dni,
  dataType: "json",
  success: function (data) {
    if (data.numeroDocumento == dni) {
	
	  $("#idTipoDoc").val(data.tipoDocumento);
      $("#idTipoDoc").selectpicker('refresh');
	  $("#nro_doc").val(data.numeroDocumento);
	  $("#razon_social").val(data.nombre);
	  $("#direccion").val(data.direccion);
	  $("#estado_sunat").val(data.estado);
      console.log(data);
    }
  },
});
}else if(dni.length==11){
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

$(".mdlProveedores").modal("show");


  
});
  // fin de la busqueda 

  //registrar proveedor
  function guardaryeditarProv(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var formData = new FormData($("#formularioProveedor")[0]);

    $.ajax({
      url: "../ajax/proveedor.php?op=guardaryeditar",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (datos) {
        mensaje(datos,"","success")
       $(".mdlProveedores").modal("hide");
       var num_doc = $("#nro_doc").val();
        obtener_proveedor(num_doc)
        console.log(num_doc)
      },
    });
    
  }
  $("#nro_documento").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: "../ajax/ingreso.php?op=autocompleteProveedor",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
          console.log(data);
          aData = $.map(data, function (value, key) {
            return {
              label: value.nro_documento + "-" + value.razon_social,
              idprov: value.idproveedor,
            };
          });
          var result = $.ui.autocomplete.filter(aData, request.term);
          response(result);
        },
      });
    },
    select: function (event, ui) {
      $("#idproveedor").val(ui.item.idprov);
    },
  });
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
            precio_prod:value.precio_costo,
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


function obtener_proveedor(nro_doc) {
  $.post(
    "../ajax/ingreso.php?op=obtener_proveedor",
    { nro_doc: nro_doc },
    function (data, status) {
      console.log("num_doc.." + nro_doc);
      data = JSON.parse(data);
      console.log(data);
      $("#idproveedor").val(data.idproveedor);
      $("#nro_documento").val(data.nro_documento + "-" + data.razon_social);
      console.log(data.nro_documento + "-" + data.razon_social);
    }
  );
}
// funciones para el detalle de compras

function abrir_detalle(idingreso){
	console.log(idingreso)
	 $(".filas").remove();
	$("#mdlDetalle_Compra").modal("show");
	obtener_cabecera_compra(idingreso)
   $.post("../ajax/ingreso.php?op=obtener_detalle_compra",{idingreso: idingreso}, function (data, status) {
    data = JSON.parse(data);
    console.log(data);
  var filas=data.length;
  for(i=0;i<filas;i++){
  
	var nueva_fila =
      '<tr class="filas" id="fila' +
      cont +
      '">' +
      '<td class="text-center">'+data[i].cantidad+'</td>'+
      '<td class="text-justify">'+data[i].producto+'</td>'+
      '<td class="text-center">'+data[i].marca+'</td>'+
      '<td class="text-center">'+"S/. "+data[i].precio_costo+'</td>'+
      '<td class="text-center">'+"S/. "+data[i].importe+'</td>'+
      "</tr>";
    cont++;
  
   $("#tbl_detalle").append(nueva_fila);
//	$("#lblProveedor").html(data[i].razon_social);
  }
    // console.log(data.id);
  });
		
}

function obtener_cabecera_compra(idingreso){
	$.post("../ajax/ingreso.php?op=obtener_cabecera_compra",{idingreso: idingreso}, function (data, status) {
    //console.log("num_doc.." + nro_doc);
     console.log(data)
    data = JSON.parse(data);
   
     $("#lblProveedor").val(data.nro_documento+" - "+data.razon_social);
    $("#fecha").val(data.fecha_hora);
    $("#documento").val(data.tipo_comprobante);
    $("#serie").val(data.serie_comprobante);
    $("#numero").val(data.num_comprobante);
    $("#lblProveedor").html(data.razon_social);
    $("#lblRuc").html(data.nro_documento);
    $("#lblDireccion").html(data.direccion);
    
    $("#fecha").html(data.fecha_hora);
    
    
    
    $("#sbtotal").html("S/. " +data.total_gravada);
    $("#igv").html("S/. " +data.total_igv);
    $("#total").html("S/. " +data.total_compra);
	
});
}
// fin de las funciones de detalle de compras
function mensaje(title,text,icon){
	Swal.fire({
  title: title,
  text: text,
  icon: icon
});
}

init();