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

<?php

/*
                <div class="row">
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="box-title"><strong>Información fiscal</strong></h4>
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
                        <Label>Nombre o razón social</label>
                      </div>
                      <div class="col-md-9">
                        <?php echo $cliente->cliente; ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label>Envío de documentos a:</label>
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
                        <label>Núm. exterior</label>
                      </div>
                      <div class="col-md-2">
                        <?php echo $cliente->numero_exterior; ?>
                      </div>
                      <div class="col-md-1">
                        <Label>Núm. interior</label>
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
                        <label>País</label>
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
      */
      ?>
 
      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Confirme los datos de su transacción</h3>
          
        </div>
        <form class="form-horizonal" role="form" method="POST" action="<?php echo $url_facturar_transaccion; ?>">
        <input type="hidden" name="id_cliente_para_facturar" id="id_cliente_para_facturar" value="<?php echo $id_cliente_para_facturar; ?>">
        <input type="hidden" name="id_trx33_r" id="id_trx33_r" value="<?php echo $id_trx33_r; ?>">
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
        
          <div class="row">
            <div class="col-md-12">

<?php
/*       
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
*/
?>              

             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <h4>Condiciones de pago y datos del encabezado</h4>
                  </div>
                </div>
              </div>

             <div class="form-group">
                <div class="row">

                      <div class="col-md-2">
                        <label class="control-label">Método de pago</label>
                      </div>
                      <div class="col-md-4">
                        <?php
                        $disabled_metodo = "";
                        if ($config_portal->activar_elegir_metodo_pago!=1) {
                          
                          echo '<input style="width:260px" type="text" name="metodo_pago" id="metodo_pago" class="form-field" value="';
                          
                            foreach($arr_metodo_pago as $metodo_pago){if($metodo_pago->id_metodo_pago==$transaccion->id_metodo_pago){echo $metodo_pago->id_metodo_pago.' - '.$metodo_pago->descripcion;}} echo '"';
                          echo '" readonly>';
                        }
                         else{ 
                        ?>
                        <select style="width: 260px" name="metodo_pago" id="metodo_pago" class="form-field" <?php echo $disabled_metodo; ?>>
                        <?php
                        foreach ( $arr_metodo_pago as $metodo ) {
                            // si es la misma
                            if ( $metodo->id_metodo_pago == $transaccion->id_metodo_pago ) {
                                echo '<option value ="'.$metodo->id_metodo_pago.'" selected>'.$metodo->id_metodo_pago.' - '.$metodo->descripcion.'</option>';
                            } else {
                                echo '<option value ="'.$metodo->id_metodo_pago.'">'.$metodo->id_metodo_pago.' - '.$metodo->descripcion.'</option>';
                            }
                        }
                        ?>
                        </select>
                        <?php
                      }
                      ?>
                      </div>
                    

                      <div class="col-md-2">
                        <label class="control-label">Forma de pago</label>
                      </div>
                      <div class="col-md-4">
                        <?php
                          if ($config_portal->activar_elegir_forma_pago!=1) {
                            
                        ?>
                        <input style="width: 260px" type="text" name="forma_pago" id="forma_pago" class="form-field" <?php
                        
                                echo 'value ="';foreach($arr_forma_pago as $forma_pago){if($forma_pago->id_forma_pago==$transaccion->id_forma_pago){echo $forma_pago->id_forma_pago.' - '.$forma_pago->descripcion;}} echo '"';
                            
                          ?> readonly>
                          <?php 
                            }
                            else{
                          ?>
                          <select style="width: 260px" name="forma_pago" id="forma_pago" class="form-field" >
                          <?php
                          foreach ( $arr_forma_pago as $forma_pago ) {
                            // si es la misma
                            if ( $forma_pago->id_forma_pago == $transaccion->id_forma_pago ) {
                                echo '<option value ="'.$forma_pago->id_forma_pago.'" selected>'.$forma_pago->id_forma_pago.' - '.$forma_pago->descripcion.'</option>';
                            } else {
                                echo '<option value ="'.$forma_pago->id_forma_pago.'">'.$forma_pago->id_forma_pago.' - '.$forma_pago->descripcion.'</option>';
                            }
                          }
                          ?>
                          </select>
                        <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div>

             <div class="form-group">
                <div class="row">
                      <div class="col-md-2">

                        
                        <label class="control-label">Uso de CFDi</label>
                      </div>
                      <div class="col-md-10">
                        <?php
                          if ($config_portal->activar_elegir_uso_cfdi!=1) {
                            echo '<input style="width: 260px" type="text" name="uso_cfdi" id="uso_cfdi" readonly value="';
                            
                                foreach ( $arr_uso_cfdi as $uso_cfdi ) {if($uso_cfdi->id_uso_cfdi==$transaccion->uso_cfdi){echo $transaccion->uso_cfdi.' - '.$uso_cfdi->descripcion;}} 
                            
                            echo '">';
                          }else{
                        ?>
                        <select style="width: 260px" name="uso_cfdi" id="uso_cfdi" class="form-field" <?php echo $disabled_uso; ?> >
                        <?php
                        foreach ( $arr_uso_cfdi as $uso_cfdi ) {
                            // si es la misma
                            if ( $uso_cfdi->id_uso_cfdi == $transaccion->uso_cfdi ) {
                                echo '<option value ="'.$uso_cfdi->id_uso_cfdi.'" selected>';
                                foreach ( $arr_uso_cfdi as $uso_cfdi ) {if($uso_cfdi->id_uso_cfdi==$transaccion->uso_cfdi){echo $transaccion->uso_cfdi.' - '.$uso_cfdi->descripcion;}} 
                                echo'</option>';
                            } else {
                                echo '<option value ="'.$uso_cfdi->id_uso_cfdi.'">'.$uso_cfdi->id_uso_cfdi.' - '.$uso_cfdi->descripcion.'</option>';
                            }
                        }
                        ?>
                        </select>
                        <?php
                      }
                      ?>
                      </div>
                    


                </div>
              </div>
              
             <div class="form-group">
                <div class="row">
                   <div class="col-md-2">
                     <label class="control-label">Moneda</label>
                   </div>
                   <div class="col-sm-2">
                     <input type="text" value="<?php echo $transaccion->id_moneda; ?>" readonly>
                   </div>
                   <div class="col-md-2">
                     <label class="control-label">Tipo cambio</label>
                   </div>
                   <div class="col-sm-2">
                     <input type="text" value="<?php echo $transaccion->tipo_cambio; ?>" readonly>
                   </div>
                </div>
              </div>
              
             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <h4>Conceptos</h4>
                  </div>
                </div>
              </div>
              
             <table class="table table-hover table-stripped table-condensed">
               <tr>
                 <th>#</th>
                 <th>CveProdServ<br>Num.Ident.</th>
                 <th>Cantidad</th>
                 <th>Unidad</th>
                 <th>Descripción</th>
                 <th>P.U.</th>
                 <th>Importe</th>
                 <th>Descuento</th>
                 <th>Info Aduanera</th>
               </tr>
               <?php
               $cont = 1;
               foreach ($conceptos as $concepto) {
                   echo '<tr>';
                   echo '<td>'.$cont.'</td>';
                   echo '<td>'.$concepto->id_claveprodserv.'<br>'.$concepto->numero_identificacion.'</td>';
                   echo '<td>'.$concepto->cantidad.'</td>';
                   echo '<td>'.$concepto->id_clave_unidad.'<br>'.$concepto->unidad.'</td>';
                   echo '<td>'.$concepto->descripcion.'</td>';
                   echo '<td>'.number_format($concepto->valor_unitario,2).'</td>';
                   echo '<td>'.number_format($concepto->importe,2).'</td>';
                   echo '<td>'.number_format($concepto->descuento,2).'</td>';
                   echo '<td>'.$concepto->info_aduanera_num_ped.'</td>';
                   echo '</tr>';
                   
                   $cont++;
               }
               ?>

             </table>
             <hr>
             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Subtotal</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo number_format($transaccion->subtotal,2); ?>" readonly>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>
             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Descuento</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo number_format($transaccion->descuento,2); ?>" readonly>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>
             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Impuestos retenidos</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo number_format($transaccion->totalImpuestosRetenidos,2); ?>" readonly>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>
             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Impuestos trasladados</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo number_format($transaccion->totalImpuestosTrasladados,2); ?>" readonly>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>
             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Total</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?php echo number_format($transaccion->total,2); ?>" readonly>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>
                
             
                


              <!--div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Uso de CFDi</label>
                    <div class="col-sm-10">
                      <select id="sucursal" name="sucursal" class="form-control">
                        <option value="-1">Elija una opción</option>
                        <option value="G01">Adquisición de mercancías</option>
                        <option value="G03">Gastos en general</option>
                      </select>
                    </div>
                  
                  </div>
                </div>
              </div-->

            
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
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->