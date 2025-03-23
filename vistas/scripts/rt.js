var tabla;
//Función que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });
  $("#mAlmacen").addClass("treeview active");
  $("#lCategorias").addClass("active");
}

function limpiar() {
  $("#idRt").val("");
  $("#nombre").val("");
  
}
//Función mostrar formulario
function mostrarform(flag) {
  limpiar();
  if (flag) {
    $("#listadoregistros").hide();
    $("#formularioregistros").show();
    //$("#btnGuardar").prop("disabled",false);
    $("#btnagregar").hide();
  } else {
    $("#listadoregistros").show();
    $("#formularioregistros").hide();
    $("#btnagregar").show();
  }
}
//Función cancelarform
function cancelarform() {
  limpiar();
  mostrarform(false);
}
//Función Listar
function listar() {
  tabla = $("#tbllistado")
    .dataTable({
      lengthMenu: [5, 10, 25, 75, 100], //mostramos el menú de registros a revisar
      aProcessing: true, //Activamos el procesamiento del datatables
      aServerSide: true, //Paginación y filtrado realizados por el servidor
      dom: "<Bl<f>rtip>", //Definimos los elementos del control de tabla
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf"],
      ajax: {
        url: "../ajax/rt.php?op=listar",
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      language: {
        lengthMenu: "Mostrar : _MENU_ registros",
        buttons: {
          copyTitle: "Tabla Copiada",
          copySuccess: {
            _: "%d líneas copiadas",
            1: "1 línea copiada",
          },
        },
      },
      bDestroy: true,
      iDisplayLength: 5, //Paginación
      order: [[0, "desc"]], //Ordenar (columna,orden)
    })
    .DataTable();
}

function guardaryeditar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  // $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "../ajax/rt.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,

    success: function (datos) {
      bootbox.alert(datos);
      $(".myModal").modal("hide");
      tabla.ajax.reload();
    },
  });
  limpiar();
}

function mostrar(idRt) {
  $.post("../ajax/rt.php?op=mostrar", { idRt: idRt },
   function (data, status) {
    data = JSON.parse(data);
    $(".myModal").modal("show");
    $("#nombre").val(data.Nombres);
    $("#idRt").val(data.idRT);
  });
}
//Función para desactivar registros
function eliminar(idRt){
    bootbox.confirm("¿Está Seguro de Eliminar RT?", function (result) {
      if (result) {
        $.post(
          "../ajax/rt.php?op=eliminar",
          { idRt: idRt },
          function (e) {
            bootbox.alert(e);
            tabla.ajax.reload();
          }
        );
      }
    });
}


//Función para activar registros


init();
