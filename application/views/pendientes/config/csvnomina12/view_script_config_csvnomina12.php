<script>
function f_agregar_linea() {
var nueva_linea = "";
var num_lineas = $("#numlineas").val();

  num_lineas++;
  
  // se crea el nuevo nodo
  nueva_linea = '\
          <div class="row"> \
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
                  <select class="form-group" id="line_type' + num_lineas + ' name="line_type' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>INVENTORY_ITEM_ID</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="inventory_item_id' + num_lineas + ' name="inventory_item_id' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>ITEM_EAN_NUMBER</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="item_ean_number' + num_lineas + ' name="item_ean_number' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>SERIAL</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="serial' + num_lineas + ' name="serial' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>DESCRIPTION</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="description' + num_lineas + ' name="description' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>QUANTITY_INVOICED</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="quantity_invoiced' + num_lineas + ' name="quantity_invoiced' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>QUANTITY_CREDITED</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="quantity_credited' + num_lineas + ' name="quantity_credited' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>UNIT_SELLING_PRICE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="unit_selling_price' + num_lineas + ' name="unit_selling_price' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>UOM_CODE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="uom_code' + num_lineas + ' name="uom_code' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>TAX_RATE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="tax_rate' + num_lineas + ' name="tax_rate' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>TAXABLE_AMOUNT</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="taxable_amount' + num_lineas + ' name="taxable_amount' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>PRECIO_NETO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="precio_neto' + num_lineas + ' name="precio_neto' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>DESCUENTO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="descuento' + num_lineas + ' name="descuento' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>VAT_TAX_ID</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="vat_tax_id' + num_lineas + ' name="vat_tax_id' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>PEDIMENTO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="pedimento' + num_lineas + ' name="pedimento' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>FECHA_PEDIMENTO</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="fecha_pedimento' + num_lineas + ' name="fecha_pedimento' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>ADUANA</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="aduana' + num_lineas + ' name="aduana' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
              <div class="col-md-1"> \
                  <label>CUENTA_PREDIAL</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="cuenta_predial' + num_lineas + ' name="cuenta_predial' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>EXTRA_TAX_RATE</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="extra_tax_rate' + num_lineas + ' name="extra_tax_rate' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
               \
              <div class="col-md-1"> \
                  <label>LINE_IS_VALID</label> \
              </div> \
              <div class="col-md-3"> \
                  <select class="form-group" id="line_is_valid' + num_lineas + ' name="line_is_valid' + num_lineas + '> \
                    <?php echo $opciones_encabezado; ?> \
                  </select> \
              </div> \
            </div> \
            <div class="col-md-12"> \
              <div class="row"> \
                <div class="col-md-11 col-md-offset-1"> \
                  <h4>Listado de Flex Lines</h4> \
                </div> \
                <div class="col-md-11 col-md-offset-1"> \
                  <div class="col-md-1"> \
                      <label>FL_CLAVE</label> \
                  </div> \
                  <div class="col-md-3"> \
                      <select class="form-group" id="fl_clave' + num_lineas + '" name="fl_clave' + num_lineas + '"> \
                        <?php echo $opciones_encabezado; ?> \
                      </select> \
                  </div> \
                   \
                  <div class="col-md-1"> \
                      <label>FL_VALOR</label> \
                  </div> \
                  <div class="col-md-3"> \
                      <select class="form-group" id="fl_valor' + num_lineas + '" name="fl_valor' + num_lineas + '"> \
                        <?php echo $opciones_encabezado; ?> \
                      </select> \
                  </div> \
                </div> \
                <div id="id_agregar_flex_line"> \
                  <div class="row"> \
                    <div class="col-md-11 col-md-offset-1"> \
                      <a href="javascript:void()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Agregar Flex Line</a> \
                    </div> \
                  </div> \
                </div> \
              </div> \
            </div> \
          </div> \
          <div id="id_agregar_linea"> \
            <div class="row"> \
              <div class="col-md-12"> \
                <a href="javascript:void()" class="btn btn-success"><i class="fa fa-plus-circle" onclick="f_agregar_linea();"></i> Agregar Línea</a> \
              </div> \
            </div> \
          </div>';
          
    // se agrega el nodo
    $("#id_agregar_linea").replaceWith(nueva_linea);
    
    // se incrementa el numero de lineas
    $("#numlineas").val(num_lineas);
}

</script>