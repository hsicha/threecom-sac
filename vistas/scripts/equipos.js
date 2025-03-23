function init(){

   $("form").keypress(function (e) {
     var key;
     if (window.event) key = window.event.keyCode; //IE
     else key = e.which; //firefox
     return key != 13;
   });
	listar();
		$.post("../ajax/equipos.php?op=select_marca",function(r){
		$("#marca").html(r);
		$("#marca").selectpicker('refresh');


	});
		$.post("../ajax/equipos.php?op=select_tipo_equipo",function(r){
		$("#marca").html(r);
		$("#marca").selectpicker('refresh');


	});
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
       url: "../ajax/equipos.php?op=listar_equipo",
       type: "GET",
       dataSrc: "",
     },
     columns: [
       { data: "equipo" },
       { data: "modelo" },
       { data: "marca" },
       { data: "caracteristica" },
       { data: "accesorio" },
       { data: "serie" },
       { data: "acciones" },
     ],
   });
}

$("#btnGuardar").on("click",function(e){
   e.preventDefault();
     var equipo = {
       idequipo: $("#idequipo").val(),
       nombre: $("#nombre").val(),
       modelo: $("#modelo").val(),
       marca: $("#marca").val(),
       caracteristicas: $("#caracteristicas").val(),
       accesorios: $("#accesorios").val(),
       serie: $("#serie").val(),
     };
     $.ajax({
       type: "POST",
       url: "../ajax/equipos.php?op=guardar_equipo",
       data: equipo,
       dataType: "JSON",
       success: function (data) {
       console.log(data);
       console.log("hola")
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
  $("#marca").val(0)
  $("#marca").selectpicker("refresh");
  $("#idequipo").val('')
  $("#nombre").val('')
  $("#modelo").val('')
  $("#marca").val('')
  $("#caracteristicas").val('')
  $("#accesorios").val('')
  $("#serie").val('')
  
  
}
function mostrar_detalle(idequipo) {
  $.post(
    "../ajax/equipos.php?op=mostrar_equipo",
    { idequipo: idequipo },
    function (data, status) {
      //console.log(data);
     data=JSON.parse(data)
   console.log(data); 
   $(".myModal").modal("show");
      $("#idequipo").val(data.id_equipo)
      $("#nombre").val(data.nombre)
       $("#modelo").val(data.modelo)
        $("#marca").val(data.idMarca)
        $("#marca").selectpicker("refresh");
      $("#caracteristicas").val(data.caracteristicas)
       $("#accesorios").val(data.accesorios)
      $("#serie").val(data.serie)
    }
  );
  
     
    
  
}
init();