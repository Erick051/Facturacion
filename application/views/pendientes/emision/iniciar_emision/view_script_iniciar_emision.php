<script>
function f_ajax_obtener_sucursales_organizacion() {
    
    var id_organizacion = $("#id_organizacion").val();
    //alert(id_organizacion);
    var laurl = "<?php echo base_url(); ?>index.php/Emision_nuevo_comprobante/ajax_listado_sucursales_organizacion/" + id_organizacion;
    
    // se hace la peticion al controlador para obtener las 
    $.get(laurl, function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
        if ( status = "success" ) {
           $('#id_sucursal').append(data);
        }
        else
        {
            Alert("Ocurrió un error al recuperar las sucursales del RFC elegido");
        }
        
    });
}

function f_ajax_obtener_sucursal_series() {
    
    var id_sucursal = $("#id_sucursal").val();
    //alert(id_sucursal);
    var laurl = "<?php echo base_url(); ?>index.php/Emision_nuevo_comprobante/ajax_listado_sucursales_series/" + id_sucursal;
    
    // se hace la peticion al controlador para obtener las 
    $.get(laurl, function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
        if ( status = "success" ) {
           $('#serie').append(data);
        }
        else
        {
            Alert("Ocurrió un error al recuperar las series del RFC y sucursal elegidos");
        }
        
    });

    laurl = "<?php echo base_url(); ?>index.php/Emision_nuevo_comprobante/ajax_domicilio_party_id/" + id_sucursal;
    
    // se hace la peticion al controlador para el domicilio 
    $.get(laurl, function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
        if ( status = "success" ) {
           $('#id_domicilio_emisor').html(data);
        }
        else
        {
            Alert("Ocurrió un error al obtener el domicilio del emisor");
        }
        
    });
}
</script>