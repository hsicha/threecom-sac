var tabla;

//Función que se ejecuta al inicio
function init(){
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	//Cargamos los items al select categoria
	$.post("../ajax/articulo.php?op=selectCategoria", function(r){
	            $("#idcategoria").html(r);
	            $('#idcategoria').selectpicker('refresh');

	});
	$.post("../ajax/articulo.php?op=selectMarca",function(r){
		$("#idmarca").html(r);
		$("#idmarca").selectpicker('refresh');


	});
	$.post("../ajax/articulo.php?op=selectUmedida", function (r) {
    $("#umedida").html(r);
    $("#umedida").selectpicker("refresh");
  });

  $.post("../ajax/articulo.php?op=selectPresentacion", function (r) {
    $("#idpresentacion").html(r);
    $("#idpresentacion").selectpicker("refresh");
  });
	$("#imagenmuestra").hide();
	$('#mAlmacen').addClass("treeview active");
    $('#lArticulos').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#idcategoria").val("");
  $("#cod_prod").val("");
  $("#descripcion").val("");
  $("#stock").val("");
  $("#precio_costo").val("");
  $("#pre_venta").val("");
$("#imagenmuestra").attr("src", "");
$("#imagenactual").val("");
  
  $("#idProducto").val("");
}



//Función cancelarform
function cerrarForm()
{
	
	limpiar();
	 $(".mdl_articulo").modal("hide");
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
        url: '../ajax/articulo.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
    },
  
  });
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/articulo.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {     console.log(datos);         
	          mensaje(datos,"","success");	          
	           $(".mdl_articulo").modal("hide");
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idarticulo)
{
	$.post(
    "../ajax/articulo.php?op=mostrar",    { idProducto: idarticulo },
    function (data, status) {
      data = JSON.parse(data);

      $("#idcategoria").val(data.idcategoria);
      $("#cod_prod").val(data.codigo_producto);
      $("#descripcion").val(data.nombre_producto);
      $("#idcategoria").val(data.idcategoria);
      $("#idcategoria").selectpicker("refresh");
       $("#idmarca").val(data.idmarca);
      $("#idmarca").selectpicker("refresh");
      $("#umedida").val(data.idunidad_medida);
      $("#umedida").selectpicker("refresh");
      $("#idpresentacion").val(data.idpresentacion);
      $("#idpresentacion").selectpicker("refresh");
      $("#stock").val(data.stock);
      $("#precio_costo").val(data.precio_costo);
      $("#pre_venta").val(data.precio_base_venta);
      $("#idProducto").val(data.idarticulo);
      $(".mdl_articulo").modal("show");
      generarbarcode();
    }
  );
}

//Función para desactivar registros
function desactivar(idarticulo)
{
	bootbox.confirm("¿Está Seguro de desactivar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/articulo.php?op=desactivar", {idarticulo : idarticulo}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function elimianr_producto(idProducto){
   console.log(idProducto);
	
  Swal.fire({
  title: "EASTA SEGURO DE ELIMINAR ESTE PRODUCTO DE USUARIO ?",
  text: "eliminar",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Confirmar"
}).then((result) => {
  if (result.isConfirmed) {
    $.post("../ajax/articulo.php?op=eliminar_prod",{idProducto:idProducto},
    function(data, status){
    	mensaje(data,status,"success");
    	tabla.ajax.reload();
    })
  }
});
	limpiar();
}

//función para generar el código de barras
function generarbarcode()
{
	codigo=$("#codigo").val();
	JsBarcode("#barcode", codigo);
	$("#print").show();
}

//Función para imprimir el Código de barras
function imprimir()
{
	$("#print").printArea();
}
function mensaje(title,text,icon){
	Swal.fire({
  title: title,
  text: text,
  icon: icon
});
}
init();