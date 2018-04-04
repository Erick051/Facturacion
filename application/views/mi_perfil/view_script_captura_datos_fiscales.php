<script>
$('#hide_div_id').hide('slow');
$(document).ready(function() {
url_ajax_rfc
   var url_ajax_cp = "<?php echo $url_ajax_cat_cp; ?>";
   var url_ajax_rfc = "<?php echo $url_ajax_rfc; ?>";
   
   $('#hide_div').click(function(){  
      $('#rfc_utilizado').hide('slow');
      $('#hide_div_id').hide('slow');
           }); 
   $('#no_col').click(function(){  
      var htmlColonia= '<input type="text" id="colonia" name="colonia" class="form-control" value="">';
      $('#div_colonia').html(htmlColonia);
           });
   $('#rfc').keyup(function(){
       
       // si ya se capturaron los 5 digitos del CP

       if ( $('#rfc').val().length > 11 ) {
           var url_final = url_ajax_rfc + $("#rfc").val();
           //alert(url_final);

         $.ajax({
              url: url_final,
              method: "GET",
              success: function(result){
            //alert(result);
                var datosCP = JSON.parse(result);
                console.log(datosCP)
              
                  if(datosCP != false){
                $('#hide_div_id').show('slow');
                $('#rfc_utilizado').show('slow');
                var rfc_utilizado  = '<div style="width: 90%;margin-left:5%;">'
                    rfc_utilizado += '<div class="row" style="margin-top: 20px">';
                    rfc_utilizado += '<label>Este RFC ya ha sido utilizado con los siguientes datos:</label>';
                    rfc_utilizado += '</div>';
                    //var w = 0;
                  //  alert(datosCP.length);
                  var w = 0;
                    $.each(datosCP,function(){
                      rfc_utilizado += '<div class="row">';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>RFC:</label><br><input type="text" name="rfc_1" id="rfc_1"  value="'+datosCP[w].rfc+'" readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>Cliente:</label><br><input type="text" name="cliente_1"  value="'+datosCP[w].cliente+'"id="cliente_!" readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>Calle:</label><br><input type="text" name="calle" id="calle"  value="'+datosCP[w].calle+'"readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>Ext:</label><br><input type="text" name="int_1" id="int_1"  value="'+datosCP[w].numero_exterior+'"readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>Int:</label><br><input type="text" name="ext_1" id="ext_1" value="'+datosCP[w].numero_interior+'" readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>Colonia:</label><br><input type="text" name="colonia_1"  value="'+datosCP[w].colonia+'"id="colonia_1" readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>Municipio:</label><br><input type="text" name="municipio_1"  value="'+datosCP[w].municipio+'"id="municipio_1" readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>Estado:</label><br><input type="text" name="municipio_1"  value="'+datosCP[w].estado+'"id="municipio_1" readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>Codigo Postal:</label><br><input type="text" name="cp_1"  value="'+datosCP[w].codigo_postal+'"id="cp_1" value="prueba" readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div class="col-md-2">';
                      rfc_utilizado += '<label>País:</label><br><input type="text" name="cp_1"  value="'+datosCP[w].pais+'"id="cp_1" value="prueba" readonly>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '</div>';
                      rfc_utilizado += '<div style=" padding-top: 20px">';
                      rfc_utilizado += '</div>';
                      w++;
                    });

                    rfc_utilizado += '</div>';    
                        $('#rfc_utilizado').html(rfc_utilizado);//modifica todo el div
                        
                        
                  }
              
              }
            });
       }
       else{
                      $('#rfc_utilizado').hide('slow');
                      $('#hide_div_id').hide('slow');
                  }
       
       
   });
   $('#cp').keyup(function(){
       
      var htmlColonia= '<input type="text" id="colonia" name="colonia" class="form-control" value="">';
      var htmlMunicipio= '<input type="text" id="municipio" name="municipio" class="form-control" value="">';
      var htmlLocalidad= '<input type="text" id="localidad" name="localidad" class="form-control" value="">';
      var htmlEstado = '<input type="text" id="estado" name="estado" class="form-control" value="">';
      var htmlPais= '<input type="text" id="pais" name="pais" class="form-control" value="">';
       // si ya se capturaron los 5 digitos del CP
       
       if ( $('#cp').val().length > 4 ) {
           var url_final = url_ajax_cp + $("#cp").val();
           //alert(url_final);

	       $.ajax({
           		url: url_final,
           		method: "GET",
           		success: function(result){
	       		
           			var datosCP = JSON.parse(result);
           			//console.log(datosCP)
	       			
               		if(datosCP != false){
                        // se llena el combo de las colonias
	       				var htmlColonia = '<select name="colonia" required class="form-control" id="colonia">';
	       				htmlColonia += '<option value="0">Seleccione una colonia</option>';
	       				$.each(datosCP,function(index,data){
	       					htmlColonia += '<option value="'+data.d_asenta+'">'+data.d_asenta+'</option>';
	       				});
                        
                        $('#div_colonia').html(htmlColonia);
                        
                        // combo de delegacion y localidad
	       				var htmlMunicipio = '<select name="municipio" required class="form-control" id="municipio">';
                        var htmlLocalidad = '<select name="localidad" required class="form-control" id="localidad">';
	       				htmlMunicipio += '<option value="'+datosCP[0].d_mnpio+'">'+datosCP[0].d_mnpio+'</option>';
                        htmlLocalidad += '<option value="'+datosCP[0].d_mnpio+'">'+datosCP[0].d_mnpio+'</option>';
                        $('#div_municipio').html(htmlMunicipio);
                        $('#div_localidad').html(htmlLocalidad);
           
                        // combo de estado
	       				var htmlEstado = '<select name="estado" required class="form-control" id="estado">';
	       				htmlEstado += '<option value="'+datosCP[0].d_estado+'">'+datosCP[0].d_estado+'</option>';
                        $('#div_estado').html(htmlEstado);
               			//38422
               		}else{
                        $('#div_colonia').html(htmlEstado);
                        $('#div_municipio').html(htmlEstado);
                        $('#div_localidad').html(htmlEstado);
                        $('#div_estado').html(htmlEstado);
                        $('#div_pais').html(htmlPais);
                        /*
               			$('#container_colonia').html('<label for="txtCalle">Colonia *:</label><input name="txtColonia" type="text" required class="form-control" id="txtColonia" placeholder="Colonia" maxlength="240">');
               			$('#txtDelegacion').val('');
               			$('#txtLocalidad').val('');
               			$('#cmbEstado').val('');
                        */
               		}
	       			
           		}
           	});
       }
       else{
        $('#div_colonia').html(htmlColonia);
        $('#div_municipio').html(htmlMunicipio);
        $('#div_localidad').html(htmlLocalidad);
        $('#div_estado').html(htmlEstado);
        $('#div_pais').html(htmlPais);
       }
       
       
   });

});
function valida_mail(){
  var mail          = document.getElementById("email").value;
  var mail_confirm  = document.getElementById("email_confirma").value;
  if (mail != mail_confirm) {
    alert("los correos no coinciden");
    document.getElementById("email_confirma").value = "";
  }
  
}

</script>