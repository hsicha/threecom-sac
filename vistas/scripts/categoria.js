var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
    $('#mAlmacen').addClass("treeview active");
    $('#lCategorias').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#idcategoria").val("");
	$("#nombre").val("");
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
		$("#btnGuardar").prop("disabled",false);
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
		   url: '../ajax/categoria.php?op=listar',
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
		url: "../ajax/categoria.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          mensaje(datos,"","success")          
	          $(".myModal").modal("hide");
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idcategoria)
{
	$.post("../ajax/categoria.php?op=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);		
		 $(".myModal").modal("show");
		

		$("#nombre").val(data.nombre);
		$("#descripcion").val(data.descripcion);
 		$("#idcategoria").val(data.idcategoria);

 	})
}

//Función para desactivar registros
function elimianr_categoria(idcategoria){
  
  Swal.fire({
  title: "EASTA SEGURO DE ELIMINAR ESTA CATEGORIA ?",
  text: "eliminar",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Confirmar"
}).then((result) => {
  if (result.isConfirmed) {
    $.post("../ajax/categoria.php?op=eliminar_cartegoria",{idcategoria:idcategoria},
    function(data, status){
    	mensaje(data,status,"success");
    	tabla.ajax.reload();
    })
  }
});
	limpiar();
}

//Función para activar registros
function activar(idcategoria)
{
	bootbox.confirm("¿Está Seguro de activar la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/categoria.php?op=activar", {idcategoria : idcategoria}, function(e){
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