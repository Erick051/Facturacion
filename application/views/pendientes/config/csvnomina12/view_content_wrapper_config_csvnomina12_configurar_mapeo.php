
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuración de mapeo de CSV
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Configuración</a></li>
        <li><a href="#">Layout CSV</a></li>
        <li class="#">Nómina 1.2</li>
        <li class="#">Cargar archivo demo</li>
        <li class="#">Muestra</li>
        <li class="active">Configurar mapeo</li>
      </ol>
    </section>

    <form class="" id="formulario_configurar_mapeo" method="post" action="<?php echo $url_guardar_mapeo; ?>">
    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Definición de layout para importación</h4>
        <p>Configure cada campo de acuerdo a la sección del documento y el complemento. Los campos marcados con <i class="fa fa-plus-circle"></i> pueden repetirse más de una vez</p>
      </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Encabezado - Datos generales del documento</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        
        
        <div class="box-body">
          <div class="row">
            <div class="col-md-1">
                <label>SERIE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="serie" name="serie">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>TRX_NUMBER</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="trx_number" name="trx_number">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>CUST_TRX_TYPE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cust_trx_type" name="cust_trx_type">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>TRX_DATE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="trx_date" name="trx_date">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>IS_PARTIALITY</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="is_partiality" name="is_partiality">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>NEEDS_CONFIRM</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="needs_confirm" name="needs_confirm">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            

          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
      <!-- emisor y reeeptor -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Bill to Customer</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>B_PARTY_ID</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_party_id" name="b_party_id">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_PARTY_NAME</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_party_name" name="b_party_name">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_PARTY_TYPE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_party_type" name="b_party_type">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_RFC</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_rfc" name="b_rfc">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_CALLE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_calle" name="b_calle">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_NE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_ne" name="b_ne">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>B_NI</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_ni" name="b_ni">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_COLONIA</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_colonia" name="b_colonia">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_CP</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_cp" name="b_cp">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_CIUDAD</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_ciudad" name="b_ciudad">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_ESTADO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_estado" name="b_estado">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_PAIS</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_pais" name="b_pais">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_LOCALIDAD</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_localidad" name="b_localidad">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_REFERENCIA</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_referencia" name="b_referencia">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_METODO_PAGO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_metodo_pago" name="b_metodo_pago">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_COND_PAGO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_cond_pago" name="b_cond_pago">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>B_DIAS_PAGO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_dias_pago" name="b_dias_pago">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_SEND_XML</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_send_xml" name="b_send_xml">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_SEND_PDF</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_send_pdf" name="b_send_pdf">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>B_EMAIL</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="b_email" name="b_email">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
      <!-- Lineas y conceptos generales del documento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Customer</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>TIPO_MONEDA</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="tipo_moneda" name="tipo_moneda">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>TASA_CAMBIO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="tasa_cambio" name="tasa_cambio">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>SELLER_ID</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="seller_id" name="seller_id">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>BUYER_ID</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="buyer_id" name="buyer_id">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>SHIP_FROM</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="ship_from" name="ship_from">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>SHIP_TO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="ship_to" name="ship_to">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>ACCOUNT_NUMBER</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="account_number" name="account_number">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Ship to</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>S_PARY_ID</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_pary_id" name="s_pary_id">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_PARTY_NAME</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_party_name" name="s_party_name">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_PARTY_TYPE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_party_type" name="s_party_type">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_RFC</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_rfc" name="s_rfc">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_CALLE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_calle" name="s_calle">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_NE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_ne" name="s_ne">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_NI</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_ni" name="s_ni">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_COLONIA</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_colonia" name="s_colonia">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_CP</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_cp" name="s_cp">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_CIUDAD</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_ciudad" name="s_ciudad">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_ESTADO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_estado" name="s_estado">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>S_PAIS</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="s_pais" name="s_pais">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
          
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Pedido</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
          
            <div class="col-md-1">
                <label>PEDIDO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="pedido" name="pedido">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>FECHA_PEDIDO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="fecha_pedido" name="fecha_pedido">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>FEC_VENC_FACT</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="fec_venc_fact" name="fec_venc_fact">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>STATUS_FACTURA</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="status_factura" name="status_factura">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>ID_SUPPLY</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="id_supply" name="id_supply">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      
      <!-- SEcciones del complemento -->
      <input type="hidden" id="num_flex_headers" name="num_flex_headers" value="1">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Flex Header</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>FH_CLAVE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="fh_clave1" name="fh_clave1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>FH_VALOR</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="fh_valor1" name="fh_valor1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
          </div>
          <div id="id_agregar_flex_header">
            <div class="row">
              <div class="col-md-12">
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_flex_header();"><i class="fa fa-plus-circle"></i> Agregar Flex Header</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      <!-- SEcciones del complemento -->
      <input type="hidden" id="num_lineas" name="num_lineas" value="1">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Líneas</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-1">
                  <label>LINE_NUMBER</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="line_number1" name="line_number1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>LINE_TYPE</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="line_type1" name="line_type1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>INVENTORY_ITEM_ID</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="inventory_item_id1" name="inventory_item_id1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>ITEM_EAN_NUMBER</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="item_ean_number1" name="item_ean_number1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>SERIAL</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="serial1" name="serial1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>DESCRIPTION</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="description1" name="description1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              <div class="col-md-1">
                  <label>QUANTITY_INVOICED</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="quantity_invoiced1" name="quantity_invoiced1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>QUANTITY_CREDITED</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="quantity_credited1" name="quantity_credited1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>UNIT_SELLING_PRICE</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="unit_selling_price1" name="unit_selling_price1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              <div class="col-md-1">
                  <label>UOM_CODE</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="uom_code1" name="uom_code1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>TAX_RATE</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="tax_rate1" name="tax_rate1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>TAXABLE_AMOUNT</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="taxable_amount1" name="taxable_amount1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              <div class="col-md-1">
                  <label>PRECIO_NETO</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="precio_neto1" name="precio_neto1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>DESCUENTO</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="descuento1" name="descuento1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>VAT_TAX_ID</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="vat_tax_id1" name="vat_tax_id1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              <div class="col-md-1">
                  <label>PEDIMENTO</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="pedimento1" name="pedimento1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>FECHA_PEDIMENTO</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="fecha_pedimento1" name="fecha_pedimento1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>ADUANA</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="aduana1" name="aduana1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              <div class="col-md-1">
                  <label>CUENTA_PREDIAL</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="cuenta_predial1" name="cuenta_predial1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>EXTRA_TAX_RATE</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="extra_tax_rate1" name="extra_tax_rate1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>LINE_IS_VALID</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="line_is_valid1" name="line_is_valid1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-11 col-md-offset-1">
                  <h4>Listado de Flex Lines</h4>
                  <input type="hidden" id="id_num_flex_lines1" name="id_num_flex_lines1" value="1">
                </div>
              </div>
              <div class="row">
                <div class="col-md-11 col-md-offset-1">
                  <div class="col-md-1">
                      <label>FL_CLAVE</label>
                  </div>
                  <div class="col-md-3">
                      <select class="form-group" id="fl_clave1_1" name="fl_clave1_1">
                        <?php echo $opciones_encabezado; ?>
                      </select>
                  </div>
                  
                  <div class="col-md-1">
                      <label>FL_VALOR</label>
                  </div>
                  <div class="col-md-3">
                      <select class="form-group" id="fl_valor1_1" name="fl_valor1_1">
                        <?php echo $opciones_encabezado; ?>
                      </select>
                  </div>

                </div>
              </div>
              <div id="id_agregar_flex_line_1">
                <div class="row">
                  <div class="col-md-11 col-md-offset-1">
                    <a href="javascript:void(0)" class="text-green" onclick="f_agregar_flex_line(1,'id_agregar_flex_line_1', 'id_num_flex_lines1');"><i class="fa fa-plus-circle"></i> Agregar Flex Line</a>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- seccion de impuestos -->
            <div class="col-md-11 col-md-offset-1">
              <div class="row">
                <div class="col-md-12">
                  <h4>Listado de impuestos de la línea</h4>
                  <input type="hidden" id="num_taxes1" name="num_taxes1" value="1">
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-1">
                    <label>TX_TYPE</label>
                </div>
                <div class="col-md-3">
                    <select class="form-group" id="tx_type1_1" name="tx_type1_1">
                      <?php echo $opciones_encabezado; ?>
                    </select>
                </div>
                
                <div class="col-md-1">
                    <label>TX_IS_RET</label>
                </div>
                <div class="col-md-3">
                    <select class="form-group" id="tx_is_ret1_1" name="tx_is_ret1_1">
                      <?php echo $opciones_encabezado; ?>
                    </select>
                </div>
                
                <div class="col-md-1">
                    <label>TX_AMOUNT</label>
                </div>
                <div class="col-md-3">
                    <select class="form-group" id="tx_amount1_1" name="tx_amount1_1">
                      <?php echo $opciones_encabezado; ?>
                    </select>
                </div>
              
              </div>
              <div id="id_agregar_tax1">
                <div class="row">
                  <div class="col-md-12">
                    <a href="javascript:void(0)" class="text-green" onclick="f_agregar_tax(1,'id_agregar_tax1', 'num_taxes1');"><i class="fa fa-plus-circle"></i> Agregar Tax</a>
                  </div>
                </div>
              </div>
            </div>
            
            
          </div>
          <div id="id_agregar_linea">
            <div class="row">
              <div class="col-md-12">
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_linea();"><i class="fa fa-plus-circle"></i> Agregar Línea</a>
              </div>
            </div>
          </div>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Encabezado del complemento</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>CN_TIPO_NOMINA</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cn_tipo_nomina" name="cn_tipo_nomina">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CN_FECHA_PAGO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cn_fecha_pago" name="cn_fecha_pago">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>CN_FECHA_INICIAL_PAGO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cn_fecha_inicial_pago" name="cn_fecha_inicial_pago">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CN_FECHA_FINAL_PAGO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cn_fecha_final_pago" name="cn_fecha_final_pago">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CN_NUM_DIAS_PAGADOS</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cn_num_dias_pagados" name="cn_num_dias_pagados">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CN_TOTAL_PERCEPCIONES</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cn_total_percepciones" name="cn_total_percepciones">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CN_TOTAL_DEDUCCIONES</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cn_total_deducciones" name="cn_total_deducciones">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CN_TOTAL_OTROS_PAGOS</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cn_total_otros_pagos" name="cn_total_otros_pagos">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow disabled">
          <h3 class="box-title">Nómina - Emisor</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>CNE_CURP</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cne_curp" name="cne_curp">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNE_REG_PATRONAL</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cne_reg_patronal" name="cne_reg_patronal">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNE_RFC_PATRON</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cne_rfc_patron" name="cne_rfc_patron">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNEE_ORIGEN_RECURSO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnee_origen_recurso" name="cnee_origen_recurso">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNEE_MONTO_RECURSO_PROPIO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnee_monto_recurso_propio" name="cnee_monto_recurso_propio">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow disabled">
          <h3 class="box-title">Nómina - Receptor</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>CNR_CURP</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_curp" name="cnr_curp">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_NUM_SEG_SOCIAL</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_num_seg_social" name="cnr_num_seg_social">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_FECHA_INICIO_REL_LAB</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_fecha_inicio_rel_lab" name="cnr_fecha_inicio_rel_lab">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_ANTIGUEDD</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_antiguedd" name="cnr_antiguedd">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_TIPO_CONTRATO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_tipo_contrato" name="cnr_tipo_contrato">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>CNR_SINDICALIZADO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_sindicalizado" name="cnr_sindicalizado">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_TIPO_JORNADA</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_tipo_jornada" name="cnr_tipo_jornada">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_TIPO_REGIMEN</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_tipo_regimen" name="cnr_tipo_regimen">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_NUM_EMPLEADO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_num_empleado" name="cnr_num_empleado">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_DEPARTAMENTO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_departamento" name="cnr_departamento">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>CNR_PUESTO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_puesto" name="cnr_puesto">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_RIESGO_PUESTO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_riesgo_puesto" name="cnr_riesgo_puesto">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_PERIODICIDAD_PAGO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_periodicidad_pago" name="cnr_periodicidad_pago">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_BANCO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_banco" name="cnr_banco">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_CUENTA_BANCARIA</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_cuenta_bancaria" name="cnr_cuenta_bancaria">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>CNR_SALARIO_BASE_COT_APOR</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_salario_base_cot_apor" name="cnr_salario_base_cot_apor">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_SALARIO_DIARIO_INTEGRADO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_salario_diario_integrado" name="cnr_salario_diario_integrado">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNR_CLAVE_ENT_FED</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnr_clave_ent_fed" name="cnr_clave_ent_fed">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNRSC_RFC_LABORA</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnrsc_rfc_labora" name="cnrsc_rfc_labora">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNRSC_PORCENTAJE_TIEMPO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnrsc_porcentaje_tiempo" name="cnrsc_porcentaje_tiempo">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->


      <!-- SEcciones del complemento -->
      <input type="hidden" id="num_percepciones" name="num_percepciones" value="1">
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Percepciones</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>CNP_TOTAL_SUELDOS</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnp_total_sueldos" name="cnp_total_sueldos">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNP_TOTAL_SEPARACION_INDEMNIZACION</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnp_total_separacion_indemnizacion" name="cnp_total_separacion_indemnizacion">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNP_TOTAL_JUBILACION_PENSION_RETIRO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnp_total_jubilacion_pension_retiro" name="cnp_total_jubilacion_pension_retiro">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNP_TOTAL_GRAVADO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnp_total_gravado" name="cnp_total_gravado">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

            <div class="col-md-1">
                <label>CNP_TOTAL_EXENTO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnp_total_exento" name="cnp_total_exento">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPS_INGRESO_ACUMULABLE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnps_ingreso_acumulable" name="cnps_ingreso_acumulable">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPS_INGRESO_NO_ACUMULABLE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnps_ingreso_no_acumulable" name="cnps_ingreso_no_acumulable">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPS_NUM_ANOS_SERVICIO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnps_num_anos_servicio" name="cnps_num_anos_servicio">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPS_TOTAL_PAGADO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnps_total_pagado" name="cnps_total_pagado">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPS_ULTIMO_SUELDO_MENS_ORD</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnps_ultimo_sueldo_mens_ord" name="cnps_ultimo_sueldo_mens_ord">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPJ_INGRESO_ACUMULABLE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnpj_ingreso_acumulable" name="cnpj_ingreso_acumulable">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPJ_INGRESO_NO_ACUMULABLE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnpj_ingreso_no_acumulable" name="cnpj_ingreso_no_acumulable">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPJ_MONTO_DIARIO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnpj_monto_diario" name="cnpj_monto_diario">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPJ_TOTAL_PARCIALIDAD</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnpj_total_parcialidad" name="cnpj_total_parcialidad">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNPJ_TOTAL_UNA_EXHIBICION</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnpj_total_una_exhibicion" name="cnpj_total_una_exhibicion">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
          <!-- seccion variable de percepciones -->
          </div>
          <div class="row">
            <div class="col-md-11 col-md-offset-1">
              <h4>Listado de percepciones</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-11 col-md-offset-1">
              <div class="col-md-1">
                  <label>CNPP_TIPO_PERCEPCION</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="cnpp_tipo_percepcion1" name="cnpp_tipo_percepcion1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>CNPP_CLAVE</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="cnpp_clave1" name="cnpp_clave1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>CNPP_CONCEPTO</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="cnpp_concepto1" name="cnpp_concepto1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>CNPP_IMPORTE_GRAVADO</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="cnpp_importe_gravado1" name="cnpp_importe_gravado1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>CNPP_IMPORTE_EXENTO</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="cnpp_importe_exento1" name="cnpp_importe_exento1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>CNPPA_VALOR_MERCADO</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="cnppa_valor_mercado1" name="cnppa_valor_mercado1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <div class="col-md-1">
                  <label>CNPPA_PRECIO_AL_OTORGARSE</label>
              </div>
              <div class="col-md-3">
                  <select class="form-group" id="cnppa_precio_al_otorgarse1" name="cnppa_precio_al_otorgarse1">
                    <?php echo $opciones_encabezado; ?>
                  </select>
              </div>
              
              <!-- HORAS EXTRA POR PERCEPCION -->
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-10 col-md-offset-2">
                    <div class="row">
                      <div class="col-md-12">
                        <h4>Horas Extra de la percepción</h4>
                        <input type="hidden" id="num_horas_extra1" name="num_horas_extra1" value="1">
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-1">
                          <label>CNPPH_DIAS</label>
                      </div>
                      <div class="col-md-3">
                          <select class="form-group" id="cnpph_dias1_1" name="cnpph_dias1_1">
                            <?php echo $opciones_encabezado; ?>
                          </select>
                      </div>
                      
                      <div class="col-md-1">
                          <label>CNPPH_TIPO_HORAS</label>
                      </div>
                      <div class="col-md-3">
                          <select class="form-group" id="cnpph_tipo_horas1_1" name="cnpph_tipo_horas1_1">
                            <?php echo $opciones_encabezado; ?>
                          </select>
                      </div>
                      
                      <div class="col-md-1">
                          <label>CNPPH_HORAS_EXTRAS</label>
                      </div>
                      <div class="col-md-3">
                          <select class="form-group" id="cnpph_horas_extras1_1" name="cnpph_horas_extras1_1">
                            <?php echo $opciones_encabezado; ?>
                          </select>
                      </div>
                      
                      <div class="col-md-1">
                          <label>CNPPH_IMPORTE_PAGADO</label>
                      </div>
                      <div class="col-md-3">
                          <select class="form-group" id="cnpph_importe_pagado1_1" name="cnpph_importe_pagado1_1">
                            <?php echo $opciones_encabezado; ?>
                          </select>
                      </div>
                    </div>
                    <div id="id_agregar_hora_extra1">
                      <div class="row">
                        <div class="col-md-12">
                          <a href="javascript:void(0)" class="text-green" onclick="f_agregar_horas_extra(1,'id_agregar_hora_extra1','num_horas_extra1');"><i class="fa fa-plus-circle"></i> Agregar Horas Extra</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="id_agregar_percepcion">
            <div class="row">
              <div class="col-md-11 col-md-offset-1">
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_percepcion();"><i class="fa fa-plus-circle"></i> Agregar Percepcion</a>
              </div>
            </div>
          </div>

            
            

          
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      
      <!-- SEcciones del complemento -->
      <input type="hidden" id="num_deducciones" name="num_deducciones" value="1">
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Deducciones</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>CND_TOTAL_OTRAS_DEDUCCIONES</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnd_total_otras_deducciones" name="cnd_total_otras_deducciones">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CND_TOTAL_IMPUESTOS_RETENIDOS</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnd_total_impuestos_retenidos" name="cnd_total_impuestos_retenidos">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h4>Listado de deducciones</h4>
            </div>
          </div>
          <div class="row">
            
            <div class="col-md-1">
                <label>CNDD_TIPO_DEDUCCION</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cndd_tipo_deduccion1" name="cndd_tipo_deduccion1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNDD_CLAVE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cndd_clave1" name="cndd_clave1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNDD_CONCEPTO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cndd_concepto1" name="cndd_concepto1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNDD_IMPORTE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cndd_importe1" name="cndd_importe1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
          </div>
          <div id="id_agregar_deduccion">
            <div class="row">
              <div class="col-md-12">
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_deduccion();"><i class="fa fa-plus-circle"></i> Agregar Deducción</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      <!-- SEcciones del complemento -->
      <input type="hidden" id="num_otros_pagos" name="num_otros_pagos" value="1">
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Otros pagos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>CNOO_TIPO_OTRO_PAGO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnoo_tipo_otro_pago1" name="cnoo_tipo_otro_pago1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNOO_CLAVE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnoo_clave1" name="cnoo_clave1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNOO_CONCEPTO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnoo_concepto1" name="cnoo_concepto1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNOO_IMPORTE</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnoo_importe1" name="cnoo_importe1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNOOS_SUBSIDIO_CAUSADO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnoos_subsidio_causado1" name="cnoos_subsidio_causado1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNOOC_SALDO_A_FAVOR</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnooc_saldo_a_favor1" name="cnooc_saldo_a_favor1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNOOC_ANO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnooc_ano1" name="cnooc_ano1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNOOC_REMANENTE_SAL_FAV</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnooc_remanente_sal_fav1" name="cnooc_remanente_sal_fav1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

          </div>
          <div id="id_agregar_otro_pago">
            <div class="row">
              <div class="col-md-12">
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_otro_pago();"><i class="fa fa-plus-circle"></i> Agregar Otro Pago</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      <!-- SEcciones del complemento -->
      <input type="hidden" id="num_incapacidades" name="num_incapacidades" value="1">
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Incapacidades</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">

            <div class="col-md-1">
                <label>CNII_DIAS_INCAPACIDAD</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnii_dias_incapacidad1" name="cnii_dias_incapacidad1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNII_TIPO_INCAPACIDAD</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnii_tipo_incapacidad1" name="cnii_tipo_incapacidad1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>
            
            <div class="col-md-1">
                <label>CNII_IMPORTE_MONETARIO</label>
            </div>
            <div class="col-md-3">
                <select class="form-group" id="cnii_importe_monetario1" name="cnii_importe_monetario1">
                  <?php echo $opciones_encabezado; ?>
                </select>
            </div>

          </div>
          <div id="id_agregar_incapacidad">
            <div class="row">
              <div class="col-md-12">
                <a href="javascript:void(0)" class="text-green" onclick="f_agregar_incapacidad();"><i class="fa fa-plus-circle"></i> Agregar Incapacidad</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
           <button type="button" class="btn btn-primary" onclick="validar_mapeo();"><i class="fa fa-save"></i> Guardar mapeo</button> <a href="<?php echo $url_anterior; ?>" class="btn btn-warning"><i class="fa fa-reply"></i> Regresar</a>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

      
      <input type="hidden" id="hubo_error" name="hubo_error" value="0">
      <input type="hidden" id="nodo_error" name="nodo_error" value="">
      <div class="example-modal">
        <div class="modal modal-danger" id="modal_error_validacion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Verifique la configuración</h4>
              </div>
              <div class="modal-body">
                <p><div id="div_mensaje_error"></div></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
    </section>
    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
