function init(){

   $("form").keypress(function (e) {
     var key;
     if (window.event) key = window.event.keyCode; //IE
     else key = e.which; //firefox
     return key != 13;
   });
	listar();
	
}
function listar(){
	 tabla = $("#tbllistado").DataTable({
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
       url: "../ajax/motivos.php?op=listar_Motivo",
       type: "GET",
       dataSrc: "",
     },
     columns: [
       { data: "motivo" },
       { data: "estado" },
       { data: "acciones" }
     ],
   });
}

$("#btnGuardar").on("click",function(e){
   e.preventDefault();
     var motivo = {
       idmotivo: $("#idmotivo").val(),
       nombre_area: $("#nombre_area").val(),
     };
     $.ajax({
       type: "POST",
       url: "../ajax/motivos.php?op=guardar_registro",
       data: motivo,
       dataType: "JSON",
       success: function (data) {
       console.log(data);
       },
       error: function (data) {
         console.log(data.responseText);
         
       },
     });
     resetform();
     listar();
     
});
function abrirModal(flag){
	if(flag){
		resetform();
		 $(".myModal").modal("show");
	}else{
		$(".myModal").modal("hide");
		resetform();
	}
	
}
function resetform() {

  $("#idmotivo").val('')
  $("#nombre_area").val('')

  
  
}
function mostrar_detalle(idmotivo) {
  $.post(
    "../ajax/motivos.php?op=mostrar_registros",
    { idmotivo: idmotivo },
    function (data, status) {
      //console.log(data);
     data=JSON.parse(data)
   console.log(data); 
   $(".myModal").modal("show");
      $("#idmotivo").val(data.idArea)
      $("#nombre_area").val(data.nombre_area)
    }
  );
  
     
    
  
}
init();