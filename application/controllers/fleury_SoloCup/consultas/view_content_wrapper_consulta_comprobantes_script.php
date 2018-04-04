<script>
 
$(document).ready(function() {
   
    //Date picker
    $('#fecha_inicio').datepicker({
        format: 'yyyy-mm-dd',
        language: "es",
        autoclose: true
    });
    
    $('#fecha_fin').datepicker({
        format: 'yyyy-mm-dd',
        language: "es",
        autoclose: true
    });

});

</script>