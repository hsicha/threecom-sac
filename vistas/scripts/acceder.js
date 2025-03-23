
var tabla_sucursal;
//Función que se ejecuta al inicio
function init(){
listar_sucursales()

}
function listar_sucursales(){
		tabla_sucursal = $("#tbllistado_sucursal").DataTable({
			
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
		 searching: false,
	
		 "ajax":{
		   url: '../ajax/usuario.php?op=listar_sucursales',
					   type : "get",
					   dataType : "json",						
					   error: function(e){
						   console.log(e);	
					   }
	   },
	 
	 });
}
function acceder(idusuario,idusuario_sede){
	console.log(idusuario +" "+idusuario_sede)
	 $.post(
    "../ajax/usuario.php?op=acceder_sistema",  { idusuario: idusuario,idusuario_sede:idusuario_sede },
    function (data, status) {
    	
     console.log(data);
    	$(location).attr("href","escritorio.php"); 
     
    }
  );
}
init()