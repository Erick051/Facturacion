<script>
function validar_mapeo() {
var hubo_error = false;
  $('select').each(function(){
      if ( $(this).val() == "-2" ){
          // se marca que hubo error
          $("#hubo_error").val(1);
          $("#nodo_error").val($(this).attr('id'));
          return;
      }
    });
    
    if ( $("#hubo_error").val() == 1 ) {
        var mensaje = "El elemento " + $("#nodo_error").val() + " no ha sido definido";
        var iderror = "#" + $("#nodo_error").val();
        $(iderror).addClass("text-red");

        
        // se establece el mensaje de error
        $("#div_mensaje_error").text(mensaje);
        
        $('#modal_error_validacion').modal();
        //alert(mensaje);
        $(iderror).focus();
        
        // se limpia el error
        $("#hubo_error").val(0);
        $("#nodo_error").val("");
        
        return false;
    }
    
    // si estuvo correcto se realiza el envio
    if ( !hubo_error ) {
        $("#formulario_configurar_mapeo").submit();
    }
}




function f_borrar_tax(id_linea, id_num_taxes) {
    $("#" + id_linea).remove();
    
    var selector_id_num_taxes = "#" + id_num_taxes;
    
    var num_taxes = $(selector_id_num_taxes).val();
    num_taxes--;
    $(selector_id_num_taxes).val(num_taxes);
}

function f_agregar_tax(num_linea_padre, id_agregar_taxes, id_num_taxes) {
var nueva_linea = "";
var selector_id_num_taxes = "#" + id_num_taxes;
var num_taxes = $(selector_id_num_taxes).val();

var id_linea_parametro = "";
var id_linea_parametro_borrar = "";
var parametros_nuevo_horas_extra = num_linea_padre + ",'" + id_agregar_taxes + "','" + id_num_taxes + "'";
  
  // se incrementa el numero de horas extra
  num_taxes++;
  
  id_linea_parametro = "tax" + num_linea_padre + "_" + num_taxes;
  id_linea_parametro_borrar = "'tax" + num_linea_padre + "_" + num_taxes + "','" + id_num_taxes +"'";

  
  // se crea el nuevo nodo
  nueva_linea = '\
              <div class="row" id="' + id_linea_parametro + '"> \
                <div class="col-md-12"> \
                  <a href="javascript:void(0)" class="text-red" onclick="f_borrar_tax(' + id_linea_parametro_borrar + ');"><i class="fa fa-times"></i> Borrar</a> \
                </div> \
                <div class="col-md-1"> \
                    <label>TX_TYPE</label> \
                </div> \
                <div class="col-md-3"> \
                    <select class="form-group" id="tx_type' + num_linea_padre + '_' + num_taxes + '" name="tx_type' + num_linea_padre + '_' + num_taxes + '"> \
                      <?php echo $opciones_encabezado; ?> \
                    </select> \
                </div> \
                <div class="col-md-1"> \
                    <label>TX_IS_RET</label> \
                </div> \
                <div class="col-md-3"> \
                    <select class="form-group" id="tx_is_ret' + num_linea_padre + '_' + num_taxes + '" name="tx_is_ret' + num_linea_padre + '_' + num_taxes + '"> \
                      <?php echo $opciones_encabezado; ?> \
                    </select> \
                </div> \
                <div class="col-md-1"> \
                    <label>TX_AMOUNT</label> \
                </div> \
                <div class="col-md-3"> \
                    <select class="form-group" id="tx_amount' + num_linea_padre + '_' + num_taxes + '" name="tx_amount' + num_linea_padre + '_' + num_taxes + '"> \
                      <?php echo $opciones_encabezado; ?> \
                    </select> \
                </div> \
              </div> \
              <div id="' + id_agregar_taxes + '"> \
                <div class="row"> \
                  <div class="col-md-12"> \
                    <a href="javascript:void(0)" class="text-green" onclick="f_agregar_tax(1,\'' + id_agregar_taxes + '\', \'' + id_num_taxes + '\');"><i class="fa fa-plus-circle"></i> Agregar Tax</a> \
                  </div> \
                </div> \
              </div> \
            </div>';
          
    // se agrega el nodo
    $("#" + id_agregar_taxes).replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $(selector_id_num_taxes).val(num_taxes);
}




function f_borrar_horas_extra(id_linea, id_num_horas_extra) {
    $("#" + id_linea).remove();
    
    var selector_id_num_horas_extra = "#" + id_num_horas_extra;
    
    var num_horas_extra = $(selector_id_num_horas_extra).val();
    num_horas_extra--;
    $(selector_id_num_horas_extra).val(num_horas_extra);
}

function f_agregar_horas_extra(num_linea_padre, id_agregar_horas_extra, id_num_horas_extra) {
var nueva_linea = "";
var selector_id_num_horas_extra = "#" + id_num_horas_extra;
var num_horas_extra = $(selector_id_num_horas_extra).val();

var id_linea_parametro = "";
var id_linea_parametro_borrar = "";
var parametros_nuevo_horas_extra = num_linea_padre + ",'" + id_agregar_horas_extra + "','" + id_num_horas_extra + "'";
  
  // se incrementa el numero de horas extra
  num_horas_extra++;
  
  id_linea_parametro = "horas_extra" + num_linea_padre + "_" + num_horas_extra;
  id_linea_parametro_borrar = "'horas_extra" + num_linea_padre + "_" + num_horas_extra + "','" + id_num_horas_extra +"'";
  
  // se crea el nuevo nodo
  nueva_linea = '\
                    <div class="row" id="' + id_linea_parametro + '"> \
                      <div class="col-md-11 col-md-offset-1"> \
                        <a href="javascript:void(0)" class="text-red" onclick="f_borrar_horas_extra(' + id_linea_parametro_borrar + ');"><i class="fa fa-times"></i> Borrar</a> \
                      </div> \
                      <div class="col-md-1"> \
                          <label>CNPPH_DIAS</label> \
                      </div> \
                      <div class="col-md-3"> \
                          <select class="form-group" id="cnpph_dias' + num_linea_padre + '_' + num_horas_extra + '" name="cnpph_dias' + num_linea_padre + '_' + num_horas_extra + '"> \
                            <?php echo $opciones_encabezado; ?> \
                          </select> \
                      </div> \
                      <div class="col-md-1"> \
                          <label>CNPPH_TIPO_HORAS</label> \
                      </div> \
                      <div class="col-md-3"> \
                          <select class="form-group" id="cnpph_tipo_horas' + num_linea_padre + '_' + num_horas_extra + '" name="cnpph_tipo_horas' + num_linea_padre + '_' + num_horas_extra + '"> \
                            <?php echo $opciones_encabezado; ?> \
                          </select> \
                      </div> \
                      <div class="col-md-1"> \
                          <label>CNPPH_HORAS_EXTRAS</label> \
                      </div> \
                      <div class="col-md-3"> \
                          <select class="form-group" id="cnpph_horas_extras' + num_linea_padre + '_' + num_horas_extra + '" name="cnpph_horas_extras' + num_linea_padre + '_' + num_horas_extra + '"> \
                            <?php echo $opciones_encabezado; ?> \
                          </select> \
                      </div> \
                      <div class="col-md-1"> \
                          <label>CNPPH_IMPORTE_PAGADO</label> \
                      </div> \
                      <div class="col-md-3"> \
                          <select class="form-group" id="cnpph_importe_pagado' + num_linea_padre + '_' + num_horas_extra + '" name="cnpph_importe_pagado' + num_linea_padre + '_' + num_horas_extra + '"> \
                            <?php echo $opciones_encabezado; ?> \
                          </select> \
                      </div> \
                    </div> \
                    <div id="' + id_agregar_horas_extra + '"> \
                      <div class="row"> \
                        <div class="col-md-12"> \
                          <a href="javascript:void(0)" class="text-green" onclick="f_agregar_horas_extra(' + parametros_nuevo_horas_extra + ');"><i class="fa fa-plus-circle"></i> Agregar Horas Extra</a> \
                        </div> \
                      </div> \
                    </div>';
          
    // se agrega el nodo
    $("#" + id_agregar_horas_extra).replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $(selector_id_num_horas_extra).val(num_horas_extra);
}














function f_borrar_flex_line(id_linea, id_num_flex_lines) {
    $("#" + id_linea).remove();
    
    var selector_id_num_flex_lines = "#" + id_num_flex_lines;
    
    var num_flex_lines = $(selector_id_num_flex_lines).val();
    num_flex_lines--;
    $(selector_id_num_flex_lines).val(num_flex_lines);
}

function f_agregar_flex_line(num_linea_padre, id_agregar_flex_line, id_num_flex_lines) {
var nueva_linea = "";
var selector_id_num_flex_lines = "#" + id_num_flex_lines;
var num_flex_lines = $(selector_id_num_flex_lines).val();

var id_linea_parametro = "";
var id_linea_parametro_borrar = "";
var parametros_nuevo_flex_line = num_linea_padre + ",'" + id_agregar_flex_line + "','" + id_num_flex_lines + "'";
  
  // se incrementa el numero de flex lines
  num_flex_lines++;
  
  id_linea_parametro = "flex_line" + num_linea_padre + "_" + num_flex_lines;
  id_linea_parametro_borrar = "'flex_line" + num_linea_padre + "_" + num_flex_lines + "','" + id_num_flex_lines +"'";
  
  // se crea el nuevo nodo
  nueva_linea = '\
              <div class="row" id="' + id_linea_parametro + '"> \
                <div class="col-md-11 col-md-offset-1"> \
                  <a href="javascript:void(0)" class="text-red" onclick="f_borrar_flex_line(' + id_linea_parametro_borrar + ');"><i class="fa fa-times"></i> Borrar</a> \
                </div> \
                <div class="col-md-11 col-md-offset-1"> \
                  <div class="col-md-1"> \
                      <label>FL_CLAVE</label> \
                  </div> \
                  <div class="col-md-3"> \
                      <select class="form-group" id="fl_clave' + num_linea_padre + '_' + num_flex_lines + '" name="fl_clave' + num_linea_padre + '_' + num_flex_lines + '"> \
                        <?php echo $opciones_encabezado; ?> \
                      </select> \
                  </div> \
                  <div class="col-md-1"> \
                      <label>FL_VALOR</label> \
                  </div> \
                  <div class="col-md-3"> \
                      <select class="form-group" id="fl_valor' + num_linea_padre + '_' + num_flex_lines + '" name="fl_valor' + num_linea_padre + '_' + num_flex_lines + '"> \
                        <?php echo $opciones_encabezado; ?> \
                      </select> \
                  </div> \
                </div> \
              </div> \
              <div id="' + id_agregar_flex_line + '"> \
                <div class="row"> \
                  <div class="col-md-11 col-md-offset-1"> \
                    <a href="javascript:void(0)" class="text-green" onclick="f_agregar_flex_line(' + parametros_nuevo_flex_line + ');"><i class="fa fa-plus-circle"></i> Agregar Flex Line</a> \
                  </div> \
                </div> \
              </div>';
          
    // se agrega el nodo
    $("#" + id_agregar_flex_line).replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $(selector_id_num_flex_lines).val(num_flex_lines);
}










function f_borrar_incapacidad(id_linea) {
    $("#" + id_linea).remove();
    
    var num_incapacidades = $("#num_incapacidades").val();
    num_incapacidades--;
    $("#num_incapacidades").val(num_incapacidades);
}

function f_agregar_incapacidad() {
var nueva_linea = "";
var num_incapacidades = $("#num_incapacidades").val();
var id_linea_parametro = "";

  num_incapacidades++;
  
  id_linea_parametro = "'incapacidad" + num_incapacidades + "'";
  
  // se crea el nuevo nodo
  nueva_linea = '\
          <div class="row" id="incapacidad' + num_incapacidades + '"> \
            <div class="col-md-12"> \
              <a href="javascript:void(0)" class="text-red" onclick="f_borrar_incapacidad(' + id_linea_parametro + ');"><i class="fa fa-times"></i> Borrar</a> \
            </div> \
            <div class="col-md-1"> \
                <label>CNII_DIAS_INCAPACIDAD</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnii_dias_incapacidad' + num_incapacidades + '" name="cnii_dias_incapacidad' + num_incapacidades + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNII_TIPO_INCAPACIDAD</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnii_tipo_incapacidad' + num_incapacidades + '" name="cnii_tipo_incapacidad' + num_incapacidades + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNII_IMPORTE_MONETARIO</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnii_importe_monetario' + num_incapacidades + '" name="cnii_importe_monetario' + num_incapacidades + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
          </div> \
          <div id="id_agregar_incapacidad"> \
            <div class="row"> \
              <div class="col-md-12"> \
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_incapacidad();"><i class="fa fa-plus-circle"></i> Agregar Incapacidad</a> \
              </div> \
            </div> \
          </div>';
          
    // se agrega el nodo
    $("#id_agregar_incapacidad").replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $("#num_incapacidades").val(num_incapacidades);
}

function f_borrar_otro_pago(id_linea) {
    $("#" + id_linea).remove();
    
    var num_otros_pagos = $("#num_otros_pagos").val();
    num_otros_pagos--;
    $("#num_otros_pagos").val(num_otros_pagos);
}

function f_agregar_otro_pago() {
var nueva_linea = "";
var num_otros_pagos = $("#num_otros_pagos").val();
var id_linea_parametro = "";

  num_otros_pagos++;
  
  id_linea_parametro = "'otro_pago" + num_otros_pagos + "'";
  
  // se crea el nuevo nodo
  nueva_linea = '\
          <div class="row" id="otro_pago' + num_otros_pagos + '"> \
            <div class="col-md-12"> \
              <a href="javascript:void(0)" class="text-red" onclick="f_borrar_otro_pago(' + id_linea_parametro + ');"><i class="fa fa-times"></i> Borrar</a> \
            </div> \
            <div class="col-md-1"> \
                <label>CNOO_TIPO_OTRO_PAGO</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnoo_tipo_otro_pago' + num_otros_pagos + '" name="cnoo_tipo_otro_pago' + num_otros_pagos + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNOO_CLAVE</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnoo_clave' + num_otros_pagos + '" name="cnoo_clave' + num_otros_pagos + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNOO_CONCEPTO</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnoo_concepto' + num_otros_pagos + '" name="cnoo_concepto' + num_otros_pagos + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNOO_IMPORTE</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnoo_importe' + num_otros_pagos + '" name="cnoo_importe' + num_otros_pagos + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNOOS_SUBSIDIO_CAUSADO</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnoos_subsidio_causado' + num_otros_pagos + '" name="cnoos_subsidio_causado' + num_otros_pagos + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNOOC_SALDO_A_FAVOR</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnooc_saldo_a_favor' + num_otros_pagos + '" name="cnooc_saldo_a_favor' + num_otros_pagos + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNOOC_ANO</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnooc_ano' + num_otros_pagos + '" name="cnooc_ano' + num_otros_pagos + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNOOC_REMANENTE_SAL_FAV</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cnooc_remanente_sal_fav' + num_otros_pagos + '" name="cnooc_remanente_sal_fav' + num_otros_pagos + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
          </div> \
          <div id="id_agregar_otro_pago"> \
            <div class="row"> \
              <div class="col-md-12"> \
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_otro_pago();"><i class="fa fa-plus-circle"></i> Agregar Otro Pago</a> \
              </div> \
            </div> \
          </div>';
          
    // se agrega el nodo
    $("#id_agregar_otro_pago").replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $("#num_otros_pagos").val(num_otros_pagos);
}

function f_borrar_deduccion(id_linea) {
    $("#" + id_linea).remove();
    
    var num_deducciones = $("#num_deducciones").val();
    num_deducciones--;
    $("#num_deducciones").val(num_deducciones);
}

function f_agregar_deduccion() {
var nueva_linea = "";
var num_deducciones = $("#num_deducciones").val();
var id_linea_parametro = "";
  num_deducciones++;
  
  id_linea_parametro = "'deduccion" + num_deducciones + "'";
  
  // se crea el nuevo nodo
  nueva_linea = '\
          <div class="row" id="deduccion' + num_deducciones + '"> \
            <div class="col-md-12"> \
              <a href="javascript:void(0)" class="text-red" onclick="f_borrar_deduccion(' + id_linea_parametro + ');"><i class="fa fa-times"></i> Borrar</a> \
            </div> \
            <div class="col-md-1"> \
                <label>CNDD_TIPO_DEDUCCION</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cndd_tipo_deduccion' + num_deducciones + '" name="cndd_tipo_deduccion' + num_deducciones + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNDD_CLAVE</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cndd_clave' + num_deducciones + '" name="cndd_clave' + num_deducciones + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNDD_CONCEPTO</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cndd_concepto' + num_deducciones + '" name="cndd_concepto' + num_deducciones + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>CNDD_IMPORTE</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="cndd_importe' + num_deducciones + '" name="cndd_importe' + num_deducciones + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
          </div> \
          <div id="id_agregar_deduccion"> \
            <div class="row"> \
              <div class="col-md-12"> \
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_deduccion();"><i class="fa fa-plus-circle"></i> Agregar Deducción</a> \
              </div> \
            </div> \
          </div>';
          
    // se agrega el nodo
    $("#id_agregar_deduccion").replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $("#num_deducciones").val(num_deducciones);
}

function f_borrar_percepcion(id_linea) {
    $("#" + id_linea).remove();
    
    var num_percepciones = $("#num_percepciones").val();
    num_percepciones--;
    $("#num_percepciones").val(num_percepciones);
}

function f_agregar_percepcion() {
var nueva_linea = "";
var num_percepciones = $("#num_percepciones").val();
var id_linea_parametro = "";

  num_percepciones++;
  id_linea_parametro = "'percepcion" + num_percepciones + "'";
  
  // se crea el nuevo nodo
  nueva_linea = '\
          <div class="row" id="percepcion' + num_percepciones + '"> \
            <div class="col-md-11 col-md-offset-1"> \
              <a href="javascript:void(0)" class="text-red" onclick="f_borrar_percepcion(' + id_linea_parametro + ');"><i class="fa fa-times"></i> Borrar</a> \
            </div> \
            <div class="col-md-11 col-md-offset-1"> \
              <div class="col-md-1"> \
                  <label>CNPP_TIPO_PERCEPCION</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="cnpp_tipo_percepcion' + num_percepciones + '" name="cnpp_tipo_percepcion' + num_percepciones + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>CNPP_CLAVE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="cnpp_clave' + num_percepciones + '" name="cnpp_clave' + num_percepciones + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>CNPP_CONCEPTO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="cnpp_concepto' + num_percepciones + '" name="cnpp_concepto' + num_percepciones + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>CNPP_IMPORTE_GRAVADO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="cnpp_importe_gravado' + num_percepciones + '" name="cnpp_importe_gravado' + num_percepciones + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>CNPP_IMPORTE_EXENTO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="cnpp_importe_exento' + num_percepciones + '" name="cnpp_importe_exento' + num_percepciones + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>CNPPA_VALOR_MERCADO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="cnppa_valor_mercado' + num_percepciones + '" name="cnppa_valor_mercado' + num_percepciones + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>CNPPA_PRECIO_AL_OTORGARSE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="cnppa_precio_al_otorgarse' + num_percepciones + '" name="cnppa_precio_al_otorgarse' + num_percepciones + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-12"> \
                <div class="row"> \
                  <div class="col-md-10 col-md-offset-2"> \
                    <div class="row"> \
                      <div class="col-md-12"> \
                        <h4>Horas Extra de la percepción</h4> \
                        <input type="hidden" id="num_horas_extra' + num_percepciones + '" name="num_horas_extra' + num_percepciones + '" value="1"> \
                      </div> \
                    </div> \
                    <div class="row"> \
                      <div class="col-md-1"> \
                          <label>CNPPH_DIAS</label> \
                      </div> \
                      <div class="col-md-3"> \
                          <select class="form-group" id="cnpph_dias' + num_percepciones + '_1" name="cnpph_dias' + num_percepciones + '_1"> \
                            <?php echo $opciones_encabezado; ?> \
                          </select> \
                      </div> \
                      <div class="col-md-1"> \
                          <label>CNPPH_TIPO_HORAS</label> \
                      </div> \
                      <div class="col-md-3"> \
                          <select class="form-group" id="cnpph_tipo_horas' + num_percepciones + '_1" name="cnpph_tipo_horas' + num_percepciones + '_1"> \
                            <?php echo $opciones_encabezado; ?> \
                          </select> \
                      </div> \
                      <div class="col-md-1"> \
                          <label>CNPPH_HORAS_EXTRAS</label> \
                      </div> \
                      <div class="col-md-3"> \
                          <select class="form-group" id="cnpph_horas_extras' + num_percepciones + '_1" name="cnpph_horas_extras' + num_percepciones + '_1"> \
                            <?php echo $opciones_encabezado; ?> \
                          </select> \
                      </div> \
                      <div class="col-md-1"> \
                          <label>CNPPH_IMPORTE_PAGADO</label> \
                      </div> \
                      <div class="col-md-3"> \
                          <select class="form-group" id="cnpph_importe_pagado' + num_percepciones + '_1" name="cnpph_importe_pagado' + num_percepciones + '_1"> \
                            <?php echo $opciones_encabezado; ?> \
                          </select> \
                      </div> \
                    </div> \
                    <div id="id_agregar_horas_extra' + num_percepciones + '"> \
                      <div class="row"> \
                        <div class="col-md-12"> \
                          <a href="javascript:void(0)" class="text-green" onclick="f_agregar_horas_extra(' + num_percepciones + ',\'id_agregar_horas_extra' + num_percepciones + '\',\'num_horas_extra' + num_percepciones + '\');"><i class="fa fa-plus-circle"></i> Agregar Horas Extra</a> \
                        </div> \
                      </div> \
                    </div> \
                  </div> \
                </div> \
              </div> \
            </div> \
          </div> \
          <div id="id_agregar_percepcion"> \
            <div class="row"> \
              <div class="col-md-11 col-md-offset-1"> \
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_percepcion();"><i class="fa fa-plus-circle"></i> Agregar Percepcion</a> \
              </div> \
            </div> \
          </div>';
          
    // se agrega el nodo
    $("#id_agregar_percepcion").replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $("#num_percepciones").val(num_percepciones);
}


function f_borrar_flex_header(id_linea) {
    $("#" + id_linea).remove();
    
    var num_flex_headers = $("#num_flex_headers").val();
    num_flex_headers--;
    $("#num_flex_headers").val(num_flex_headers);
}

function f_agregar_flex_header() {
var nueva_linea = "";
var num_flex_headers = $("#num_flex_headers").val();
var id_linea_parametro = "";

  num_flex_headers++;
  id_linea_parametro = "'flex_header" + num_flex_headers + "'";
  
  // se crea el nuevo nodo
  nueva_linea = '\
          <div class="row" id="flex_header' + num_flex_headers + '"> \
            <div class="col-md-12"> \
              <a href="javascript:void(0)" class="text-red" onclick="f_borrar_flex_header(' + id_linea_parametro + ');"><i class="fa fa-times"></i> Borrar</a> \
            </div> \
            <div class="col-md-1"> \
                <label>FH_CLAVE</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="fh_clave' + num_flex_headers + '" name="fh_clave' + num_flex_headers + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
            <div class="col-md-1"> \
                <label>FH_VALOR</label> \
            </div> \
            <div class="col-md-3"> \
                <select class="form-group" id="fh_valor' + num_flex_headers + '" name="fh_valor' + num_flex_headers + '"> \
                  <?php echo $opciones_encabezado; ?> \
                </select> \
            </div> \
          </div> \
          <div id="id_agregar_flex_header"> \
            <div class="row"> \
              <div class="col-md-12"> \
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_flex_header();"><i class="fa fa-plus-circle"></i> Agregar Flex Header</a> \
              </div> \
            </div> \
          </div>';
          
    // se agrega el nodo
    $("#id_agregar_flex_header").replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $("#num_flex_headers").val(num_flex_headers);
}

function f_borrar_linea(id_linea) {
    $("#" + id_linea).remove();
    
    var num_lineas = $("#num_lineas").val();
    num_lineas--;
    $("#num_lineas").val(num_lineas);
    
}

function f_agregar_linea() {
var nueva_linea = "";
var id_linea_parametro = "";
var num_lineas = $("#num_lineas").val();

  num_lineas++;
  
  id_linea_parametro = "'linea" + num_lineas + "'";
  
  // se crea el nuevo nodo
  nueva_linea = '\
          <div class="row" id="linea' + num_lineas + '"> \
            <div class="col-md-12"> \
              <a href="javascript:void(0)" class="text-red" onclick="f_borrar_linea(' + id_linea_parametro + ');"><i class="fa fa-times"></i> Borrar</a> \
            </div> \
            <div class="col-md-12"> \
              <div class="col-md-1"> \
                  <label>LINE_NUMBER</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="line_number' + num_lineas + '" name="line_number' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>LINE_TYPE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="line_type' + num_lineas + '" name="line_type' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>INVENTORY_ITEM_ID</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="inventory_item_id' + num_lineas + '" name="inventory_item_id' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>ITEM_EAN_NUMBER</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="item_ean_number' + num_lineas + '" name="item_ean_number' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>SERIAL</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="serial' + num_lineas + '" name="serial' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>DESCRIPTION</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="description' + num_lineas + '" name="description' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>QUANTITY_INVOICED</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="quantity_invoiced' + num_lineas + '" name="quantity_invoiced' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>QUANTITY_CREDITED</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="quantity_credited' + num_lineas + '" name="quantity_credited' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>UNIT_SELLING_PRICE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="unit_selling_price' + num_lineas + '" name="unit_selling_price' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>UOM_CODE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="uom_code' + num_lineas + '" name="uom_code' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>TAX_RATE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="tax_rate' + num_lineas + '" name="tax_rate' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>TAXABLE_AMOUNT</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="taxable_amount' + num_lineas + '" name="taxable_amount' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>PRECIO_NETO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="precio_neto' + num_lineas + '" name="precio_neto' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>DESCUENTO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="descuento' + num_lineas + '" name="descuento' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>VAT_TAX_ID</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="vat_tax_id' + num_lineas + '" name="vat_tax_id' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>PEDIMENTO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="pedimento' + num_lineas + '" name="pedimento' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>FECHA_PEDIMENTO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="fecha_pedimento' + num_lineas + '" name="fecha_pedimento' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>ADUANA</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="aduana' + num_lineas + '" name="aduana' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>CUENTA_PREDIAL</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="cuenta_predial' + num_lineas + '" name="cuenta_predial' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>EXTRA_TAX_RATE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="extra_tax_rate' + num_lineas + '" name="extra_tax_rate' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>LINE_IS_VALID</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="line_is_valid' + num_lineas + '" name="line_is_valid' + num_lineas + '"> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
            </div> \
            <div class="col-md-12"> \
              <div class="row"> \
                <div class="col-md-11 col-md-offset-1"> \
                  <h4>Listado de Flex Lines</h4> \
                  <input type="hidden" id="id_num_flex_lines' +  num_lineas + '" name="id_num_flex_lines' +  num_lineas + '" value="1"> \
                </div> \
              </div> \
              <div class="row"> \
                <div class="col-md-11 col-md-offset-1"> \
                  <div class="col-md-1"> \
                      <label>FL_CLAVE</label> \
                  </div> \
                  <div class="col-md-3"> \
                      <select class="form-group" id="fl_clave' +  num_lineas + '_1" name="fl_clave' +  num_lineas + '_1"> \
                        <?php echo $opciones_encabezado; ?> \
                      </select> \
                  </div> \
                  <div class="col-md-1"> \
                      <label>FL_VALOR</label> \
                  </div> \
                  <div class="col-md-3"> \
                      <select class="form-group" id="fl_valor' +  num_lineas + '_1" name="fl_valor' +  num_lineas + '_1"> \
                        <?php echo $opciones_encabezado; ?> \
                      </select> \
                  </div> \
                </div> \
              </div> \
              <div id="id_agregar_flex_line_' +  num_lineas + '"> \
                <div class="row"> \
                  <div class="col-md-11 col-md-offset-1"> \
                    <a href="javascript:void(0)" class="text-green" onclick="f_agregar_flex_line(' +  num_lineas + ',\'id_agregar_flex_line_' +  num_lineas + '\', \'id_num_flex_lines' +  num_lineas + '\');"><i class="fa fa-plus-circle"></i> Agregar Flex Line</a> \
                  </div> \
                </div> \
              </div> \
            </div> \
            <div class="col-md-11 col-md-offset-1"> \
              <div class="row"> \
                <div class="col-md-12"> \
                  <h4>Listado de impuestos de la línea</h4> \
                  <input type="hidden" id="num_taxes' +  num_lineas + '" name="num_taxes' +  num_lineas + '" value="1"> \
                </div> \
              </div> \
              <div class="row"> \
                <div class="col-md-1"> \
                    <label>TX_TYPE</label> \
                </div> \
                <div class="col-md-3"> \
                    <select class="form-group" id="tx_type' +  num_lineas + '_1" name="tx_type' +  num_lineas + '_1"> \
                      <?php echo $opciones_encabezado; ?> \
                    </select> \
                </div> \
                <div class="col-md-1"> \
                    <label>TX_IS_RET</label> \
                </div>  \
                <div class="col-md-3"> \
                    <select class="form-group" id="tx_is_ret' +  num_lineas + '_1" name="tx_is_ret' +  num_lineas + '_1"> \
                      <?php echo $opciones_encabezado; ?> \
                    </select> \
                </div> \
                <div class="col-md-1"> \
                    <label>TX_AMOUNT</label> \
                </div> \
                <div class="col-md-3"> \
                    <select class="form-group" id="tx_amount' +  num_lineas + '_1" name="tx_amount' +  num_lineas + '_1"> \
                      <?php echo $opciones_encabezado; ?> \
                    </select> \
                </div> \
              </div> \
              <div id="id_agregar_tax' +  num_lineas + '"> \
                <div class="row"> \
                  <div class="col-md-12"> \
                    <a href="javascript:void(0)" class="text-green" onclick="f_agregar_tax(' +  num_lineas + ',\'id_agregar_tax' +  num_lineas + '\', \'num_taxes' +  num_lineas + '\');"><i class="fa fa-plus-circle"></i> Agregar Tax</a> \
                  </div> \
                </div> \
              </div> \
            </div> \
          </div> \
          <div id="id_agregar_linea"> \
            <div class="row"> \
              <div class="col-md-12"> \
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_linea();"><i class="fa fa-plus-circle"></i> Agregar Línea</a> \
              </div> \
            </div> \
          </div>';
          
    // se agrega el nodo
    $("#id_agregar_linea").replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $("#num_lineas").val(num_lineas);
}

</script>