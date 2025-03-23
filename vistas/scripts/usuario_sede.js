var tabla;

//Función que se ejecuta al inicio
function init(){

	listar();
	listar_user_combo();
	listar_combo_sucursal()
	$('#mAcceso').addClass("treeview active");
    $('#lPermisos').addClass("active");
}

//Función mostrar formulario
function listar_user_combo(){
	$.post("../ajax/usuario_sede.php?op=listar_combo_user",
	function(data){
	console.log(data);
//	console.log(JSON.parse(data));
	$("#idUsuario").html(data);
	$("#idUsuario").selectpicker('refresh');});
}


function listar_combo_sucursal(){
	$.post("../ajax/usuario_sede.php?op=listar_combo_sede",
	function(data){
	console.log(data);
//	console.log(JSON.parse(data));
	$("#id_sede").html(data);
	$("#id_sede").selectpicker('refresh');});

}


function listar()
{
	
		tabla = $("#tbllistado").DataTable({
		bLengthChange: false,
		autoWidth: false,
		 bDestroy: true,
		 language: {
		   lengthMenu:    "Mostrar _MENU_ Elementos",
		   info:           "Mostrando _START_ a _END_ de _TOTAL_ Elementos",
		   infoEmpty:      "Mostrando 0 registros de 0 registros encontrados",
		   paginate: {
			 next: "<span>Siguiente</span>",
			 previous: "<span>Atras</span>",
		   },
		 },
	  
		 responsive: true,
		 searching: false,
		 	"ajax":
				{
					url: '../ajax/usuario_sede.php?op=listar',
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
	if($("#id_sede_user").val()===""){
		insertar_usuario_sede();	
	}else{
		actualizar_usuario_sede();	
	}
  tabla.ajax.reload();
  limpiar();
	
})
function limpiar(){
$("#id_sede_user").val();
 $("#idUsuario").selectpicker("refresh");
$("#id_sede").selectpicker("refresh");	
}
function insertar_usuario_sede(){
	var idUsuario=$("#idUsuario").val();
	var id_sede=$("#id_sede").val();
	var data={idUsuario:idUsuario,id_sede:id_sede};
	$.post("../ajax/usuario_sede.php?op=guardar_usuario_sede",data,
 function(datos,estado){
 	mensaje(datos,"","success")
     $(".myModal").modal("hide");
      
 })	
}

function actualizar_usuario_sede(){
	var id_sede_user=$("#id_sede_user").val();
	var idUsuario=$("#idUsuario").val();
	var id_sede=$("#id_sede").val();
	var data={id_sede_user:id_sede_user,idUsuario:idUsuario,id_sede:id_sede};
	console.log(data);
	$.post("../ajax/usuario_sede.php?op=actualizar_usuario_sede",data,
 function(datos,estado){
 	mensaje(datos,"","success")
     $(".myModal").modal("hide");
     
 })	
}
function eliminar(id_sede){
  Swal.fire({
  title: "EASTA SEGURO DE ELIMINAR ESTE REGISTRO ?",
  text: "eliminar",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Confirmar"
}).then((result) => {
  if (result.isConfirmed) {
      $.post("../ajax/usuario_sede.php?op=eliminar",{id_sede:id_sede},
    function(data, status){
    	mensaje(data,status,"success");
    	tabla.ajax.reload();
    })
  }
  
});
	limpiar();
}
function mostrar(id_sede){
	 $.post(
    "../ajax/usuario_sede.php?op=mostrar",
    { id_sede: id_sede },
    function (data, status) {
      data = JSON.parse(data);
      $(".myModal").modal("show");
      $("#id_sede_user").val(data.idusuario_sede);
      $("#idUsuario").val(data.idusuario);
      $("#idUsuario").selectpicker("refresh");
      $("#id_sede").val(data.id_sede);
      $("#id_sede").selectpicker("refresh");
    }
  );
}
function mensaje(title,text,icon){
	Swal.fire({
  title: title,
  text: text,
  icon: icon
});
}

init();