function init() {
 
 var fecha___;
  $("form").keypress(function (e) {
    var key;
    if (window.event) key = window.event.keyCode; //IE
    else key = e.which; //firefox
    return key != 13;
  });


  fecha_actual();

  $.post("../ajax/control_caja.php?op=select_servicio", function (r) {
    $("#cmb_servicio").html(r);
    $("#cmb_servicio").selectpicker("refresh");
  });
}


 var now = new Date();
 var day = ("0" + now.getDate()).slice(-2);
 var month = ("0" + (now.getMonth() + 1)).slice(-2);
 var today = now.getFullYear() + "-" + month + "-" + day;
fecha___ = today;
listar(fecha___);
obtener_total(fecha___);
limpiar()

function fecha_actual() {
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear() + "-" + month + "-" + day;
  $("#fecha").val(today);
  

}
$("#btn_guardar").on("click",function(){
 var fecha_tr = document.getElementById("fecha").value;
 console.log("imprimiendo fecha.." + fecha_tr);
})


function resetform() {
  $("#marca").val(0);
  $("#marca").selectpicker("refresh");
  $("#idequipo").val("");
  $("#nombre").val("");
  $("#modelo").val("");
  $("#marca").val("");
  $("#caracteristicas").val("");
  $("#accesorios").val("");
  $("#serie").val("");
}
function listar(fecha) {
 var cont = 0;
console.log("fecha.." + fecha)
  $.ajax({
    type: "POST",
    url: "../ajax/control_caja.php?op=listar",
    data: { fecha: fecha },
    success: function (data) {
         
         data=JSON.parse(data)
        console.log(data);
        limpiarBody();
      for (var i = 0; i < data.length; i++) {
        console.log(data[i][0].nombre_servicio);
        var nueva_fila =
          '<tr>' +
          '<td>' +
          data[i][0].fecha +
          "</td>" +
          '<td>' +data[i][0].nombre_servicio +'</td>' +
          '<td>' +data[i][0].cantidad +'</td>' +
          '<td>' +data[i][0].precio +'</td>' +
          '<td>' +data[i][0].total +'</td>' +
          "</tr>";
        cont++;
        $("#tbl_data").append(nueva_fila);
       
      }
    },
    error: function (d) {
      console.log(d.responseText);
    },
  });
}
	$("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });
function guardaryeditar(e)
{
	e.preventDefault();
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
    url: "../ajax/control_caja.php?op=guardar_detalle",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
      console.log(datos);
      listar(fecha___);
      obtener_total(fecha___);
      limpiar();
    },
  });
}
function limpiarBody() {
  document.getElementById("tbl_data").querySelector("tbody").innerHTML = "";
  
}
function obtener_total(fecha){
     $.ajax({
       type: "POST",
       url: "../ajax/control_caja.php?op=obtener_total",
       data: { fecha: fecha },
       success: function (data) {
        data=JSON.parse(data)
        if(data.total==null){
          var tot=0.0;
          $("#lblTotal").text("TOTAL S/. " + " " + tot);
        }else{
          tot=data.total;
          $("#lblTotal").text("TOTAL S/. " + " " + tot);
        }
        
       },
     });
}
$(document).on("keyup", "#cantidad", function () {
calcular_totales();
});
$(document).on("keyup", "#precio", function () {
  calcular_totales();
});
function calcular_totales(){
  var cantidad=document.getElementById("cantidad");
  var precio=document.getElementById("precio")
  var total=Number.parseFloat(cantidad.value*precio.value).toFixed(2);
  $("#total").val(total);
}
function limpiar(){
  $("#cantidad").val("1")
  $("#precio").val("0");
  $("#total").val("0");
}
$("input[type=date]").change(function () {
  var filtro_fecha=$("#fecha").val();
  limpiarBody();
  listar(filtro_fecha);
  obtener_total(filtro_fecha);
});
init();
