<script>
 
$(document).ready(function() {
   
   $("#formulario_entrega").hide();

});

function segundo_plano(tipo)
{
    $("#tipo_consulta").val(tipo);
    
    if ( tipo == 1 ) {
        $("#formulario_entrega").show();
    } else {
        $("#formulario_consulta").submit();
    }
    
}


</script>