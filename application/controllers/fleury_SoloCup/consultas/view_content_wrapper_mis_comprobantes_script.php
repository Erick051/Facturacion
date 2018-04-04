<script src="<?php echo base_url()."assets/plugins/input-mask/jquery.inputmask.js"; ?>"></script>
<script src="<?php echo base_url()."assets/plugins/input-mask/jquery.inputmask.extensions.js"; ?>"></script>
<script src="<?php echo base_url()."assets/plugins/input-mask/jquery.inputmask.date.extensions.js"; ?>"></script>
<script src="<?php echo base_url()."assets/plugins/datepicker/bootstrap-datepicker.js"; ?>"></script>
<script>
 
$(document).ready(function() {
  
    //Date picker
    $('#fecha_emision_desde').datepicker({
        format: 'yyyy-mm-dd',
        language: "es",
        autoclose: true
    });
    
    //Date picker
    $('#fecha_emision_hasta').datepicker({
        format: 'yyyy-mm-dd',
        language: "es",
        autoclose: true
    });

    //Date picker
    $('#fecha_timbrado_desde').datepicker({
        format: 'yyyy-mm-dd',
        language: "es",
        autoclose: true
    });

    //Date picker
    $('#fecha_timbrado_hasta').datepicker({
        format: 'yyyy-mm-dd',
        language: "es",
        autoclose: true
    });

    $('#box_envio_correo').hide();
    //$('#box_anexos').hide();

    /*<?php
    // si se encontraron resultados
    if ( count($arrcomprobantes) > 0) {
    ?>
    // listado de resultados
    $('#listado_comprobantes').DataTable( {
        "paging": false,
        "order": [[ 2, 'asc' ], [ 3, 'asc' ],[ 4, 'asc' ], [ 5, 'asc' ], [ 6, 'asc' ], [ 7, 'asc' ], [ 8, 'asc' ]],
        "bInfo" : false,
       "language": {
         "search": "Filtrar registros:"
       }
    } );
    <?php
    }
    ?>*/
});

function envia_xml(id_docto) {
    $('#box_envio_correo').hide();
    $('#id_docto').val(id_docto);
    $('#box_envio_correo').show("slow");
    $('html, body').animate({
        scrollTop: $("#box_envio_correo").offset().top
    }, 1000);
}
function anexos_download(id_trx33){
    if ($("#box_anexos"+id_trx33).is(":hidden")) {
        $('#box_envio_correo').hide();
        $('#id_trx33').val(id_trx33);
        
        $('#box_anexos'+id_trx33).show("slow");
        /*$('html, body').animate({
            scrollTop: $("#box_anexos"+id_trx33).offset().top
        }, 1000);    */
    }
    else{
        $('#box_anexos'+id_trx33).hide("slow");
    }
    
    
}

function envio_masivo() {
    var id_docto = $('#id_docto_todos').val();
    
    $('#id_docto').val(id_docto);
    $('#box_envio_correo').show("slow");
    $("#box_envio_correo").slideDown( "slow");
    
    $('html, body').animate({
        scrollTop: $("#box_envio_correo").offset().top
    }, 1000);
}

function seleccionar_todos(source) {
    //alert(source.checked);
    $('input[type="checkbox"]').prop("checked", source.checked);
}
myVar = setInterval(check_all_chks, 300);
function check_all_chks(){
    var checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    var chkbx_all   =document.getElementById("all");
    var contador    = 0;
    var aux         = 0;
        for(i=0;i<checkboxes.length;i++) //recorremos todos los controles
        {
            if(checkboxes[i].type == "checkbox" && checkboxes[i].value!="all" && checkboxes[i].value!="on"){
                aux++; 
            }
            if(checkboxes[i].type == "checkbox" && checkboxes[i].value!="all" && checkboxes[i].value!="on" && checkboxes[i].checked==1) //solo si es un checkbox entramos
            {
                contador++;
            }
        }
        if (contador != aux) {
            chkbx_all.checked = 0;
        }
        if (contador==aux){
            chkbx_all.checked = 1;
        } //alert('contados: '+contador+'--- aux:'+aux);
}

/*function deseleccionar_todos() {
    $('input[type="checkbox"]').prop("checked", false);
}*/
function ids_consultas(){
    var checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    var chkbx_all=document.getElementById("all");
    var aux=0;
        for(i=0;i<checkboxes.length;i++) //recorremos todos los controles
        {
            if(checkboxes[i].type == "checkbox" && checkboxes[i].checked == "1" && checkboxes[i].value!="all" && checkboxes[i].value!="on") //solo si es un checkbox entramos
            {
                if(aux==0){
                    aux = checkboxes[i].value;
                }
                else{
                    aux+=','+checkboxes[i].value;
                }
            }
        }
        if (aux!=0) {
            document.getElementById('id_seleccionados').value = aux;
        }
        else{
            alert("Debes seleccionar al menos un comprobante.");
        }
}
function enviar_elegidos() {
    $("#formulario_comprobantes").submit();
}

function descargar_reporte(){
    $("#descargar_reporte_excel").submit();
}
function descargar_anexo(id_trx){
    $('#id_trx').val(id_trx);
    $("#archivo_anexo"+id_trx).submit();
}
function descargar_reportepss(){
    $("#descargar_reporte_excelpss").submit();
}
</script>