var tabla;

//Función que se ejecuta al inicio
function init(){
	listar();
	//Cargamos los items al select cliente
	$.post("../ajax/venta.php?op=selectCliente", function(r){
	            $("#idcliente").html(r);
	            $('#idcliente').selectpicker('refresh');
	});
	$('#mConsultaV').addClass("treeview active");
    $('#lConsulasV').addClass("active");
    
    fecha_actual();
}


//Función Listar
function fecha_actual(){
 var now = new Date();
 var day = ("0" + now.getDate()).slice(-2);
 var month = ("0" + (now.getMonth() + 1)).slice(-2);
 var today = now.getFullYear() + "-" + month + "-" + day;
 
 $("#fecha_inicio").val(today);
 $("#fecha_fin").val(today);
}
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
		   url: '../ajax/consultas.php?op=ventasfechacliente',
					   type : "get",
					   dataType : "json",						
					   error: function(e){
						   console.log(e.responseText);	
					   }
	   },
	 
	 });
}
function mostrar(id)
{
  //window.open("../ajax/pruebas.php?id="+id)
   $("#cnt_1").attr("src","../ajax/enviar_sunat.php?id=" + id + "&opc=imprime_ticket"
   );
 
  $("#idventa").val(id);
  console.log("id venta  "+id)
  $("#mdlPDF1").modal("show");
  
}
function imprimir(id){
  
       // alert('ok');

  $("#contenedor_pdf").attr( "src","../ajax/enviar_sunat.php?id=" + id + "&opc=imprime_pdf");
  $("#mdlPDF").modal("show");
}

function dowload_file(ruc, cod_document, serie, numero){
	
	
	let serie3 = String(serie).slice(0, 3)
	
	console.log("serie3", serie3)
	
	if(serie3 == "888"){
		new_serie = String(serie).replace("888", "BBB");
	}else{
		new_serie = String(serie).replace("999", "FFF");
	}
	
	
	tipo_doc = String(cod_document).padStart(2,"0");
	numeracion = String(numero).padStart(7,"0");
	console.log("nueva serie "+ new_serie);
	let url='https://apis.sichasoft.com/DEMO_API_SUNAT/files/facturacion_electronica/FIRMA/'+String(ruc)+'-'+tipo_doc+'-'+new_serie+'-'+numeracion+'.xml';
	console.log("entra", url)
	
	$.ajax({
        url: '../ajax/consultas.php?op=descargarXml',
        type: "get",
        dataType: "JSON",
        data: {
            nom_file : url,
        },
        success: function (r) {
				var $a = $("<a>");
	            $a.attr("href", '../ajax/'+r);
	            $("body").append($a);
	            $a.attr("download", new_serie+'-'+numeracion+'.xml');
	            $a[0].click();
	            $a.remove();
    			console.log("r", r)
        }
    })

}
	  let ruc="";
	  var cod_doc=""
	  var serie="";
	  var numero="";

function obtener_ruc_serie(id_venta){
	
	$.post("../ajax/consultas.php?op=obtener_ruc_serie_nume",{ id_venta:id_venta},
	function(data, status){
	  dataJson=JSON.parse(data);
	  console.log(dataJson);
	  ruc=dataJson.empresa;
	  cod_doc=dataJson.codigo_documento;
	  serie=dataJson.serie;
	  numero=dataJson.numero;
	  descargar_PDF(ruc,cod_doc,serie,numero)
	})
	console.log("valor del ruc "+ ruc);
	
}
function descargar_PDF(ruc, cod_document, serie, numero){
	
	var name_file=ruc +'-'+cod_document+'-'+serie+'-'+numero+'.pdf';
	 //var fileUrl =`http://apis.sichasoft.com/DEMO_API_SUNAT/files/facturacion_electronica/PDF/${name_file}`;
	console.log(name_file);
	 var fileUrl = 'http://apis.sichasoft.com/DEMO_API_SUNAT/files/facturacion_electronica/PDF/'+name_file; // Cambia esto por la URL del archivo que deseas descargar
                $.ajax({
                    url: '../ajax/consultas.php?op=descargar_pdf', // Cambia esto por la ruta a tu script PHP
                    method: 'GET',
                    data: { url: fileUrl },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(data, status, xhr) {
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = fileUrl.split('/').pop(); // Nombre del archivo
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    }
                });
            
}
init();