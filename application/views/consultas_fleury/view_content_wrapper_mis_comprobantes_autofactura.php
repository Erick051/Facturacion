  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mis comprobantes emitidos
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Filtro de consulta</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            <div class="row">
              <div class="col-md-12">
                    <?php
                    if ( isset($titulo) ) {
                    ?>
                      <div class="<?php echo $tipo_mensaje; ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-exclamation-circle"></i> <?php echo $titulo; ?></h4>
                        <?php echo $mensaje; ?>
                      </div>
                    <?php
                    }
                    ?>
              </div>
            </div> 
            <form id="formulario_consulta" method="post" action="<?php echo $url_consultar_comprobantes_pss; ?>">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Emisor</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-1">
                      <label>RFC</label>
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="rfc_emisor" name="rfc_emisor" value="" class="form-control">
                    </div>
                    <div class="col-md-1">
                      <label>Nombre</label>
                    </div>
                    <div class="col-md-7">
                      <input type="text" id="nombre_emisor" name="nombre_emisor" value="" class="form-control">
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Receptor</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-1">
                      <label>RFC</label>
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="rfc_receptor" name="rfc_receptor" value="" class="form-control">
                    </div>
                    <div class="col-md-1">
                      <label>Nombre</label>
                    </div>
                    <div class="col-md-7">
                      <input type="text" id="nombre_receptor" name="nombre_receptor" value="" class="form-control">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-1">
                      <label>País residencia</label>
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="pais_residencia" name="pais_residencia" value="" class="form-control">
                    </div>
                    <div class="col-md-1">
                      <label>Num. Reg Id Trib</label>
                    </div>
                    <div class="col-md-7">
                      <input type="text" id="num_reg_id_trib" name="num_reg_id_trib" value="" class="form-control">
                    </div>
                  </div>

                </div>

              </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-1">
                   <label>Serie</label>
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="serie" name="serie" class="form-control">
                  </div>
                  <div class="col-md-1">
                   <label>Folio</label>
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="folio_inicio" name="folio_inicio" class="form-control" placeholder="Inicio">
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="folio_fin" name="folio_fin" class="form-control" placeholder="Fin">
                  </div>
                  <div class="col-md-1">
                   <label>UUID</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" id="uuid" name="uuid" class="form-control" placeholder="Folio fiscal UUID">
                  </div>
                </div>
              </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-2">
                   <label>Fecha de emisión</label>
                  </div>
                  <div class="col-md-2">
                    <input type="date" id="fecha_emision_desde" name="fecha_emision_desde" class="form-control" placeholder="Inicio">
                  </div>
                  <div class="col-md-2">
                    <input type="date" id="fecha_emision_hasta" name="fecha_emision_hasta" class="form-control" placeholder="Fin">
                  </div>
                  <div class="col-md-2">
                   <label>Fecha de timbrado</label>
                  </div>
                  <div class="col-md-2">
                    <input type="date" id="fecha_timbrado_desde" name="fecha_timbrado_desde" class="form-control" placeholder="Inicio">
                  </div>
                  <div class="col-md-2">
                    <input type="date" id="fecha_timbrado_hasta" name="fecha_timbrado_hasta" class="form-control" placeholder="Fin">
                  </div>
                </div>
              </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-1">
                   <label>Moneda</label>
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="moneda" name="moneda" class="form-control">
                  </div>
                  <div class="col-md-1">
                   <label>Monto</label>
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="monto_desde" name="monto_desde" class="form-control" placeholder="Inferior">
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="monto_hasta" name="monto_hasta" class="form-control" placeholder="Superior">
                  </div>
                  <!--div class="col-md-1">
                   <label>Tipo</label>
                  </div-->
                  <input type="hidden" name="tipo_comprobante" value="---">
                  <!--div class="col-md-3">
                    <select id="tipo_comprobante" name="tipo_comprobante" class="form-control">
                      <option value="---">Tipo</option>
                      <option value="ingreso">Ingreso</option>
                      <option value="egreso">Egreso</option>
                    </select>
                  </div-->
                </div>
              </div>
<?php
/*
             <div class="form-group">
                <div class="row">
                  <div class="col-md-1">
                   <label>Concepto</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" id="concepto" name="concepto" class="form-control" placeholder="Concepto/item">
                  </div>
                  <div class="col-md-1">
                   <label>Clave Prod Servicio</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" id="clave_prod_serv" name="clave_prod_serv" class="form-control" placeholder="Clave producto/servicio del SAT">
                  </div>
                </div>
              </div>
*/
?>
             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                   <input type="submit" value="Buscar" class="btn btn-success pull-right">
                  </div>                  
                </div>
              </div>
            </div>
            </form>
            <!-- /.box-body -->
          </div>
         <?php
         // si ya se hizo una busqueda
         if ( isset($arrcomprobantes) ) {
         ?>
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de comprobantes</h3>
              <button class="btn btn-success" id="btn_reporte_excel" onclick="descargar_reporte()"><i class="fa fa-file-excel-o"></i> Reporte</button>
              <?php
                $array_ids = '';
                foreach ($arrcomprobantes as $comprobante) {
                  if ($array_ids=='') {
                    $array_ids = $comprobante["id_trx33"];
                  }else{
                  $array_ids = $array_ids.','.$comprobante["id_trx33"];
                  }
                }
              ?>
              <form id="descargar_reporte_excel" method="post" action="<?php echo $url_reporte_excelpss; ?>"> 
                <input type="hidden" name="id_consulta" id="id_consulta" value="<?php echo $array_ids; ?>">
              
              <?php
              if ( count($arrcomprobantes) > 0 ) {
                  //echo '<a href="javascript:void(0);" onclick="envio_masivo();" class="btn btn-warning pull-right"><i class="fa fa-plus"></i> Enviar todos</a>';
              }
              //print_r($arrcomprobantes);
              ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              
              <div class="table-responsive">
                <table id="listado_comprobantes" class="table table-striped table-condensed table-hover">
                  <thead>
                  <tr>
                    <!--<th>*</th>-->
                    <th>#</th>
                    <th>RFC emisor</th>
                    <th>Emisor</th>
                    <th>RFC Receptor</th>
                    <th>Receptor</th>
                    <th>Serie</th>
                    <th>Folio</th>
                    <th>UUID</th>
                    <th>Fecha<br>Timbrado</th>
                    <!--th>Estatus</th-->
                    <!--th>Fecha<br>Cancelación</th-->
                    <th>Moneda</th>
                    <!--th>Tipo<br>Cambio</th-->
                    <th>Total</th>
                    <th>Archivos</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if ( count($arrcomprobantes) > 0 ) {
                      
                      $conteo = 0;
                      $monto_total_facturas = 0;
                      $id_docto = "";
                      //echo '<form method="post">';
                      //$arrchks = array();
                      foreach ($arrcomprobantes as $comprobante) {
                          $conteo++;
                          /*echo '<tr>';
                          ?>      <td>
                                    <p>
                                      <input type="checkbox" name="check_list[]" value="<?php echo $comprobante->id_trx33; ?>" />
                                      
                                    </p>
                                  </td>
                          <?php */
                          //array_push($arrchks, $comprobante->id_trx33);//agrega el id del checkbox al array
                          echo '  <td>'.$conteo.'</td>';
                          echo '  <td>'.$comprobante["rfc_emisor"].'</td>';
                          echo '  <td>'.$comprobante["nombre_emisor"].'</td>';
                          echo '  <td>'.$comprobante["rfc_receptor"].'</td>';
                          echo '  <td>'.$comprobante["nombre_receptor"].'</td>';
                          echo '  <td>'.$comprobante["serie"].'</td>';
                          echo '  <td>'.$comprobante["folio"].'</td>';
                          echo '  <td>'.$comprobante["uuid"].'</td>';
                          echo '  <td>'.$comprobante["fecha_timbrado"].'</td>';
                          //echo '  <td>VIGENTE</td>';
                          //echo '  <td>'.$comprobante->fecha_cancelacion.'</td>';
                          echo '  <td>'.$comprobante["moneda"].'</td>';
                          //echo '  <td>'.$comprobante->tipo_cambio.'</td>';
                          echo '  <td>'.number_format(round($comprobante["total"],2),2).'</td>';
                          
                          // se calculan las urls para descarga
                          $url_descarga_xml_individual = $url_descarga_xml."/".$comprobante["id_trx33"];
                          $url_descarga_pdf_individual = $url_descarga_pdf."/".$comprobante["id_trx33"];
                          $url_envio_correo_individual = "envia_xml(".$comprobante["id_trx33"].");";
                          $url_docs_anexos             = $url_docs_anexos;
                          echo '  
                          <td>
                            <a href="'.$url_descarga_xml_individual.'" title="Descargar XML"><i class="fa fa-file-code-o"></i> </a> 
                            <a href="'.$url_descarga_pdf_individual.'" title="Descargar PDF"><i class="fa fa-file-pdf-o"></i> </a> 
                            <a href="javascript:void(0)" onclick="'.$url_envio_correo_individual.'" title="Enviar por email"><i class="fa fa-envelope"></i></a>

                            ';

                            foreach ($arr_anexos_clientes as $arr_anexos) {
                              if ($arr_anexos->id_trx33 == $comprobante["id_trx33"]) {
                                echo '<a href="javascript:void(0)" onclick="anexos_download('.$comprobante["id_trx33"].');" title="Ver Anexos"><i class="fa fa-paperclip"></i></a> ';
                                
                               

                            
              ?>
              <div style="display:none;" class="anexos_box" id="box_anexos<?php echo $comprobante["id_trx33"]; ?>">
            
              
                        <form id="archivo_anexo<?php echo $arr_anexos->id_anexo; ?>" method="post" action="<?php echo $url_docs_anexos.'/'.$arr_anexos->id_anexo; ?>"> <?php
                        if ($arr_anexos->id_trx33 == $comprobante["id_trx33"]) {
                      
                          ?>
                            <div style="width: 100px;font-size: 10px"><?php echo $arr_anexos->nombre_anexo; ?></div>
                            <div style="width: 100px;width: 10%">
                              
                                <input type="hidden" name="id_trx33_anexos<?php echo $arr_anexos->id_anexo; ?>" title='id_trx33_anexos<?php echo $arr_anexos->id_anexo; ?>' value="<?php echo $arr_anexos->id_anexo ?>">
                                <a class="btn fa fa-download" id="descargar_archivo_anexo" title='id_trx33_anexos<?php echo $arr_anexos->id_anexo; ?>' onclick="descargar_anexo(<?php echo $arr_anexos->id_anexo; ?>)"></a>
                            </div>
                        
                          <?php
                         }
                         ?>
                         </form>
                         <?php
                      }
                    }
                      ?>
          </div>
              <?php
                            echo '</td>';
                          //echo '  <td><a href="'.$url_descarga_xml_individual.'" title="Descargar XML"><i class="fa fa-file-code-o"></i> </a> <a href="'.$url_descarga_pdf_individual.'" title="Descargar PDF"><i class="fa fa-file-pdf-o"></i> </a> <a href="javascript:void(0)" onclick="'.$url_envio_correo_individual.'" title="Enviar por email"><i class="fa fa-envelope"></i> </a></td></td>';
                          echo '</tr>';
                          
                          $monto_total_facturas += $comprobante["total"];
                          
                          // se concatenan los documentos
                          if ( $conteo == 1 ) {
                             $id_docto .= $comprobante["id_trx33"];
                          } else {
                             $id_docto .= ",".$comprobante["id_trx33"];
                          }
                          
                      }
                    echo '</form>';
                  
                  } else {
                    echo '<tr>';
                    echo '<td colspan="13">No se encontraron registros con los parámetros de búsqueda indicados. Intente de nuevo por favor con otros valores.</td>';
                    echo '<tr>'; 
                  }
                  ?>
                 </tbody>
                </table>
                <?php
                // si hubo registros se muestran los totales
                if ( count($arrcomprobantes) > 0 ) {
                    ?>
                <table class="table table-stripped table-hover table-condensed">
                  <tr>
                    <th colspan="3">Núm. documentos: <?php echo $conteo; ?></th>
                    <th colspan="7">Monto total:</th>
                    <th colspan="2"><?php echo number_format(round($monto_total_facturas,2),2); ?></th>
                  </tr>
                </table>
                <?php
                } // si hay registros
                ?>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.box -->
          <?php
          if ( isset($id_docto) ) {
          ?>
          

         <div class="box" id="box_envio_correo">
            <div class="box-header">
              <h3 class="box-title">Enviar por correo</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form id="formulario_correo" method="post" action="<?php echo $url_envio_correo; ?>">
            <div class="form-group">
                <label>Enviar documento elegido a la(s) dirección(es):</label>
                <input type="hidden" id="id_docto" name="id_docto" value="<?php echo $id_docto; ?>">
                <input type="hidden" id="id_docto_todos" name="id_docto_todos" value="<?php echo $id_docto; ?>">
                <br>
                <label style="font-size: 12px;color: grey">Separar correos por coma sin espacio.</label>
                <br>
                <label style="font-size: 10px; color: grey">Ejemplo: correo@mail.com,prueba@correo.com</label>
                <input type="text" id="email_destinatario" name="email_destinatario" value="" class="form-control">
            </div>


            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-md-12">
                  <input type="submit" class="btn btn-success" value="Enviar">
                </div>
              </div>
            </div>
            </form>
         </div>
         <?php
          } // si id_docto existe
          //if (isset($id_docto)) {
            ?>
            
            <?php
          //}
          
          } // isset($arrcomprobantes)
          ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

