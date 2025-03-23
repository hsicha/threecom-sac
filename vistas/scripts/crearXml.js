
$(document).ready(function(){
  // obtener_venta_empresa();
})

function obtener_venta_empresa(){
  console.log('hola');
  $.ajax({
    url: "../ajax/pruebas.php",
    type: "GET",
    dataType: "JSON",
    success: function (data) {
      console.log(data);
    },
  });
    
}