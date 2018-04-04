<script src="<?php echo base_url()."assets/plugins/input-mask/jquery.inputmask.js"; ?>"></script>
<script src="<?php echo base_url()."assets/plugins/input-mask/jquery.inputmask.extensions.js"; ?>"></script>
<script src="<?php echo base_url()."assets/plugins/input-mask/jquery.inputmask.date.extensions.js"; ?>"></script>
<script src="<?php echo base_url()."assets/plugins/datepicker/bootstrap-datepicker.js"; ?>"></script>
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

<script>

$(document).ready(function() {



   <?php
   // para cada campo de captura
   foreach ( $arr_campos_transaccion as $campo ) {
       // si es campo numerico o de texto
       if ( $campo->clave_tipo_dato == "date" ) {
       ?>
    //Date picker
    $('#<?php echo $campo->campo_adicional; ?>').datepicker({
        format: 'yyyy-mm-dd',
        language: "es",
        autoclose: true
    });
   <?php
     } // para campo que es fecha
   }
    ?>
});


var timepicker = new TimePicker('HORA', {
  lang: 'pt',
  theme: 'blue-grey'
});
timepicker.on('change', function(evt) {

  var value = (evt.hour || '00') + ':' + (evt.minute || '00');
  evt.element.value = value;

});


</script>
