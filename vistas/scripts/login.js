$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();
   var datos={logina:logina,clavea:clavea}
   console.log(datos)
    $.post("../ajax/usuario.php?op=verificar",datos,
        function(data)
    {
    	console.log(data);
        if (data!="null")
        {
        //	console.log(data);
            $(location).attr("href","acceder.php");            
        }
        else
        {
          bootbox.alert("Usuario y/o Password incorrectos");
          //console.log(data);
          //console.log(data);
        }
    });
})