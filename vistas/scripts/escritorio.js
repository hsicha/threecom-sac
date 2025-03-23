var tabla;
function init() {
	listar();
	
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
		order: [[3, 'asc']],
      responsive: true,
      searching: true,
      "ajax":{
        url: '../ajax/articulo.php?op=stock_minimo',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
    },
  
  });
}
init();