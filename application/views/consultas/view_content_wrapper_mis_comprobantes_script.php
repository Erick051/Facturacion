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
function merge_pdf(){
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
            document.getElementById('ids_merge').value = aux;

            $("#merge_masivo").submit();
        }
        else{
            alert("Debes seleccionar al menos un comprobante.");
        }
}

function envia_xml(id_docto) {
    if (id_docto=='') {
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
            document.getElementById('ids_merge').value = aux;
            $('#box_envio_correo').hide();
            $('#id_docto').val(id_docto);
            $('#box_envio_correo').show("slow");
            document.getElementById("id_docto").value = id_docto;
            $('html, body').animate({
                scrollTop: $("#box_envio_correo").offset().top
            }, 1000);
        }
        else{
            alert("Debes seleccionar al menos un comprobante.");
        }
    }
    else{
        $('#box_envio_correo').hide();
        $('#id_docto').val(id_docto);
        $('#box_envio_correo').show("slow");
        document.getElementById("id_docto").value = id_docto;
        $('html, body').animate({
            scrollTop: $("#box_envio_correo").offset().top
        }, 1000);
    }
    
}
function anexos_download(id_trx33){
    if ($("#box_anexos"+id_trx33).is(":hidden")) {
        $('#box_envio_correo').hide();
        $('#id_trx33').val(id_trx33);
        
        $('#box_anexos'+id_trx33).show("slow");
        $('html, body').animate({
            scrollTop: $("#box_anexos"+id_trx33).offset().top
        }, 1000);    
    }
    else{
        $('#box_anexos'+id_trx33).hide("slow");
    }
    
    
}
function enviar_elegidos_pss() {
    var checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    var ids_consulta = '';
    var aux = 1;
    for(i=0;i<checkboxes.length;i++) //recorremos todos los controles
        {
            if(checkboxes[i].type == "checkbox" && checkboxes[i].value!="all" && checkboxes[i].value!='on' && checkboxes[i].checked==1) //solo si es un checkbox entramos
            {
                if (aux == 1) {
                    ids_consulta = checkboxes[i].value.toString();
                    //alert('1: '+ids_consulta);
                }
                else{
                    ids_consulta += ","+checkboxes[i].value.toString();
                    //alert('2: '+ids_consulta);
                }
                aux++; 
            }
        }
    if (aux > 1) {
        //alert(ids_consulta);
        document.getElementById('ids_consulta').value = ids_consulta;
        $("#download_masivo").submit();
    }
    else{
        alert('Debe seleccionar al menos un comprobante.');
        window.stop(1000);
    }
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
function selector_chkbx(source){
    var checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    var chkbx_all=document.getElementById("all");
    
        for(i=0;i<checkboxes.length;i++) //recorremos todos los controles
        {
            if(checkboxes[i].type == "checkbox" && checkboxes[i].value!="all") //solo si es un checkbox entramos
            {
                checkboxes[i].checked = chkbx_all.checked;
            }
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
function activos_on(){
    document.getElementById("solo_cancelados").checked = 0;
}
function cancelados_on(){
    document.getElementById("solo_activos").checked = 0;
}
function seleccionar_todos() {
    $('input[type="checkbox"]').prop("checked", true);
}

function deseleccionar_todos() {
    $('input[type="checkbox"]').prop("checked", false);
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