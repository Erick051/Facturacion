<script>

$(document).ready(function() {

   var url_ajax_series = "<?php echo $url_ajax_series_entidad; ?>";

   $('#id_entidad').change(function(){
        var url_final = url_ajax_series + $("#id_entidad").val();
        //alert(url_final);

	    $.ajax({
        		url: url_final,
        		method: "GET",
        		success: function(result){
	    		
        			var datosSeries = JSON.parse(result);
        			//console.log(datosCP)
	    			
            		if(datosSeries != false){
                     // se llena el combo de las colonias
	    				var htmlSeries = '<select name="serie" required class="form-control" id="serie">';
	    				htmlSeries += '<option value="0">Selecciona una serie</option>';
	    				$.each(datosSeries,function(index,data){
	    					htmlSeries += '<option value="'+data.serie+'">'+data.serie+'</option>';
	    				});
                     
                     $('#serie').html(htmlSeries);
                     
            		}else{
                     alert("Por favor verifique su instalación y configuración\n\n No se encontraron series disponibles para asignar a autofacturación, esto puede ser porque ya está asignada una serie a la entidad elegida o porque la entidad elegida no tiene definidas series.");
            		}
	    			
        		}
        	});
       
       
       
       
   });

});
 

</script>