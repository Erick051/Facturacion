<script>
function validar_consulta() {
var hubo_error = false;
var nodo_error = "";

  if ( $("#id_mes").val() == -2 ) {
      nodo_error = "Mes";
      hubo_error = true;     
  } else if ( $("#id_ano").val() == -2 ) {
      nodo_error = "Año";
      hubo_error = true;
  }
    
    if ( hubo_error ) {
        var mensaje = "El elemento " + nodo_error + " no ha sido definido";
        // se establece el mensaje de error
        $("#div_mensaje_error").text(mensaje);
        
        $('#modal_error').modal();
        return false;
    }
    
    // si estuvo correcto se realiza el envio
    if ( !hubo_error ) {
        $("#formulario_inicio_conciliacion").submit();
    }
}

</script>