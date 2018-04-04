<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Facturación de tickets
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Facturación</a></li>
      <li class="active">Captura datos del ticket</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

        <!-- general form elements -->
        <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">

              <div class="row">
                <div class="col-md-12">
                      <?php
                      if ( isset($titulo) ) {
                      ?>
                        <div class="<?php echo $tipo_mensaje; ?>">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">Ã—</button>
                          <h4><i class="icon fa fa-exclamation-circle"></i> <?php echo $titulo; ?></h4>
                          <?php echo $mensaje; ?>
                        </div>
                      <?php
                      }
                      ?>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="box-title"><strong>InformaciÃ³n fiscal</strong></h4>
                    </div>
                  </div>
                  <div class="row">
                    <!-- emisor -->
                    <div class="col-md-3">
                      <label>RFC</label>
                    </div>
                    <div class="col-md-9">
                      <?php echo $cliente->rfc; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <Label>Nombre o razÃ³n social</label>
                    </div>
                    <div class="col-md-9">
                      <?php echo $cliente->cliente; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <label>EnvÃ­o de documentos a:</label>
                    </div>
                    <div class="col-md-9">
                      <?php echo $cliente->email; ?>
                    </div>
                  </div>

                </div>
                <div class="col-md-8">
                  <div class="row">
                    <!-- emisor -->
                    <div class="col-md-12">
                      <h4 class="box-title"><strong>Domicilio</strong></h4>
                    </div>
                  </div>


                  <div class="row">
                    <!-- emisor -->
                    <div class="col-md-1">
                      <label>Calle</label>
                    </div>
                    <div class="col-md-11">
                      <?php echo $cliente->calle; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-1">
                      <label>NÃºm. exterior</label>
                    </div>
                    <div class="col-md-2">
                      <?php echo $cliente->numero_exterior; ?>
                    </div>
                    <div class="col-md-1">
                      <Label>NÃºm. interior</label>
                    </div>
                    <div class="col-md-2">
                      <?php echo $cliente->numero_interior; ?>
                    </div>
                    <div class="col-md-1">
                      <label>C. P.</label>
                    </div>
                    <div class="col-md-1">
                      <?php echo $cliente->codigo_postal; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-1">
                      <label>Colonia</label>
                    </div>
                    <div class="col-md-11">
                      <?php echo $cliente->colonia; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-1">
                      <label>Municipio</label>
                    </div>
                    <div class="col-md-5">
                       <?php echo $cliente->municipio; ?>
                    </div>
                    <div class="col-md-1">
                      <label>Localidad</label>
                    </div>
                    <div class="col-md-5">
                      <?php echo $cliente->localidad; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-1">
                      <label>Estado</label>
                    </div>
                    <div class="col-md-2">
                      <?php echo $cliente->estado; ?>
                    </div>
                    <div class="col-md-1">
                      <label>PaÃ­s</label>
                    </div>
                    <div class="col-md-2">
                      <?php echo $cliente->pais; ?>
                    </div>
                  </div>
                </div>

            </div>
            <!-- /.box-body -->

        </div>

        <!-- /.box -->
      </div>


    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Datos de la transacciÃ³n</h3>

      </div>
      <form class="form-horizonal" role="form" method="POST" action="<?php echo $url_vista_previa; ?>">
      <input type="hidden" name="id_cliente_para_facturar" id="id_cliente_para_facturar" value="<?php echo $cliente->id_cliente; ?>">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
           <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                Teclee aquÃ­ la informaciÃ³n de su ticket de compra para obtener la factura
              </div>
            </div>
           </div>
<?php
/*
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Marca</label>
                  <div class="col-sm-10">
                    <select id="marca" name="marca" class="form-control">
                      <option value="-1">Elija una marca</option>
                      <?php
                      foreach ($marcas as $marca) {
                          echo '<option value="'.$marca->PARTY_ID.'">'.$marca->PARTY_NAME.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            */
?>
           <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Sucursal</label>
                    <div class="col-sm-10">
                      <select id="sucursal" name="sucursal" class="form-control">
                        <?php
                        foreach ($arr_entidades as $unaEntidad ) {
                          echo '<option value="'.$unaEntidad->id_entidad.'">'.$unaEntidad->entidad.'</option>';
                        }
                        ?>

                      </select>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <?php
            // para cada campo de captura
            if ( count($arr_campos_transaccion) > 0 && $arr_campos_transaccion != null ) {


                foreach ( $arr_campos_transaccion as $campo ) {
                    // si es campo numerico o de texto

                    if ($campo->clave_tipo_dato != "date" &&  $campo->clave_tipo_dato != "time") {

                    ?>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">

                      <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $campo->etiqueta_flex_header; ?></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="<?php echo $campo->campo_adicional; ?>" id="<?php echo $campo->campo_adicional; ?>" placeholder="<?php echo $campo->descripcion; ?>">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                    <?php
                    }
                  else if($campo->clave_tipo_dato == "time") {
                    // campo de hora
                    //var_dump( $campo->etiqueta_flex_header);
                    ?>
                 <div class="form-group">
                   <div class="row">
                    <div class="col-md-12">

                      <label class="col-sm-2 control-label"><?php echo $campo->etiqueta_flex_header; ?></label>
                      <div class="col-sm-10">

                          <input type="text" class="form-control selector" id="<?php echo $campo->campo_adicional; ?>" name="<?php echo $campo->campo_adicional; ?>" >

                      </div>

                    </div>
                  </div>
                </div>
                    <?php
                    }else {
                    // campo de fecha
                    ?>
                 <div class="form-group">
                   <div class="row">
                    <div class="col-md-12">

                      <label class="col-sm-2 control-label"><?php echo $campo->etiqueta_flex_header; ?></label>
                      <div class="col-sm-10">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="<?php echo $campo->campo_adicional; ?>" name="<?php echo $campo->campo_adicional; ?>">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                    <?php
                    }
                }
            } // si hay campos definidos
            else {
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <span>No se han configurado los campos para buscar transacciÃ³n.</span>
                  </div>
                </div>
                <?php
            }
            ?>



            <!--div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Uso de CFDi</label>
                  <div class="col-sm-10">
                    <select id="sucursal" name="sucursal" class="form-control">
                      <option value="-1">Elija una opciÃ³n</option>
                      <option value="G01">AdquisiciÃ³n de mercancÃ­as</option>
                      <option value="G03">Gastos en general</option>
                    </select>
                  </div>

                </div>
              </div>
            </div-->


          </div>
          <div class="col-md-6">
            <!-- imagen guia -->
            <div class="row">
              <div class="col-sm-12">
                <img class="img-responsive" src="<?php echo $url_guia_ticket; ?>" alt="GuÃ­a de ticket">
                <h4>Ejemplo de comprobante impreso</h4>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <input type="submit" class="btn btn-success" value="Continuar"> <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>
      </div>
      </form>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->


    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
