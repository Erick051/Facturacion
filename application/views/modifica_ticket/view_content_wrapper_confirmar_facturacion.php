  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modificación de tickets <span style="font-size: 15px;margin-left: 10px"><?php echo $mensaje; ?></span>
      </h1> 
      
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Modifica</a></li>
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
          <h3 class="box-title">Modifique los datos de su transacción</h3>
          
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
                            if ( $metodo->id_metodo_pago == $transaccion->metodo_pago ) {
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
                            if ( $forma_pago->id_forma_pago == $transaccion->forma_pago ) {
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
                   <div class="col-sm-4">
                     <input style="width: 260px" type="text" name="moneda" id="moneda" value="<?php echo $transaccion->id_moneda; ?>"  >
                   </div>
                   <div class="col-md-2">
                     <label class="control-label">Tipo cambio</label>
                   </div>
                   <div class="col-sm-2">
                     <input type="text" name="tipocambio" id="tipocambio" value="<?php echo $transaccion->tipo_cambio; ?>"  >
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
                 <th>Eliminar</th>
               </tr>
               <?php
               $cont = 1;
               foreach ($conceptos as $concepto) {
               $url_elimina = $url_elimina_concepto."/".$concepto->descripcion."/".$concepto->id_trx33_conceptos."/".$concepto->id_trx33;
                   echo '<tr>';
                   echo '<td>'.$cont.'</td>';
                   echo '<td>'.$concepto->clave_prod_serv.'<br>'.$concepto->numero_identificacion.'</td>';
                   echo '<td><input style="width:60px" onchange="actualizatotal('.$concepto->cantidad.','.$cont.','.$concepto->valor_unitario.','.$concepto->descuento.')" type="text" name="quantity'.$cont.'" id="quantity'.$cont.'" value="'.$concepto->cantidad.'"></td>';
                   echo '<td>'.$concepto->clave_unidad.'<br>'.$concepto->unidad.'</td>';
                   echo '<td>'.$concepto->descripcion.'</td>';
                   echo '<td><input readonly style="width:90px" name="unitario'.$cont.'" id="unitario'.$cont.'" value="'.number_format($concepto->valor_unitario,2).'"></td>';
                   echo '<td><input readonly style="width:90px" name="importe'.$cont.'" id="importe'.$cont.'" value="'.number_format($concepto->importe,2).'"></td>';
                   echo '<td><input readonly style="width:90px" name="Descuento'.$cont.'" id="Descuento'.$cont.'" value="'.number_format($concepto->descuento,2).'"></td>';
                   echo '<td>'.$concepto->info_aduanera_num_ped.'</td>';
                   echo '<td><input type="hidden" value="0" id="id_elimina" name="id_elimina"><input type="button" onclick="eliminar('.$concepto->id_trx33_concepto_r.')" title="Eliminar registro" value="x" style="color:white;background-color:red"></td>';
                   echo '</tr>';
                   
                   $cont++;
               }
               $tasa_cuota    ='0.00';
               $tipo_impuesto ='';
               foreach ($impuesto->result() as $impuesto) {
                 $tasa_cuota    = $impuesto->tasa_o_cuota;
                 $tipo_impuesto = $impuesto->tipo_impuesto;

               }
                   echo '<td><input type="hidden" name="tasa_cuota" id="tasa_cuota" value="'.$tasa_cuota.'"></td>';
               ?>
             </table>
             <hr>
             <center><!-- Preguntar si eliminar -->
              <div style="display:none; border: solid; width: 30%; height: 65px; margin-top: -40px;margin-left: 65%; position: absolute;box-shadow: 0px 2px 15px" id="pregunta">
                <a href="javascript:void(0)" onclick="'.$url_envio_correo_individual.'" title="Enviar por email">
                  
                </a>
                <label>¿Está seguro de eliminar el concepto?</label><br>
                <input type="button" onclick="eliminar('Y')" value="Si" name="" style="background-color: green;color: white;">
                <input type="button" onclick="eliminar('N')" value="No" name="" style="background-color: red;color: white;">
              </div>
            </center>
             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Subtotal</label>
                      <div class="col-sm-10">
                        <input type="text" readonly name="SubTotal" id="SubTotal"  >
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
                        <input type="text" readonly name="Descuento" id="Descuento" value=""  >
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
                        <input type="text" readonly id="Retenidos" name="Retenidos" value="<?php echo number_format($transaccion->total_impuestos_retenidos,2); ?>"  >
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
                        <input type="text" readonly id="Trasladados" name="Trasladados" value="<?php echo number_format($transaccion->total_impuestos_trasladados,2); ?>"  >
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
                        <input type="text" readonly id="Total" name="Total" value="<?php echo number_format($transaccion->total,2); ?>"  >
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
          <input type="submit" class="btn btn-success" value="Continuar"> 
          <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>
        </div>
        </form>
        <!-- /.box-footer-->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

               <script> 
                function eliminar(id_concepto){ 
                  
                  if(id_concepto != 'Y' && id_concepto != 'N'){
                    document.getElementById("id_elimina").value = id_concepto;
                    //alert(id_concepto);
                    if ($("#pregunta").is(":hidden")) {
                      $('#pregunta').show('slow');
                    }
                    else{
                        $('#pregunta').hide('slow');
                    }
                  }
                  if(id_concepto == 'Y'){
                    var url_eliminar = "<?php echo $url_elimina_concepto; ?>/<?php echo $concepto->descripcion; ?>/<?php echo $concepto->id_trx33_r; ?>/"+document.getElementById("id_elimina").value;
                    alert(url_eliminar);
                    location.href =url_eliminar;
                  }
                  if(id_concepto == 'N'){
                    $('#pregunta').hide('slow');
                    document.getElementById("id_elimina").value = "0";
                  }
                 }

               </script>
               <script type="text/javascript">
                
                  var cont = parseFloat('<?php echo $cont; ?>');
                  var subtotal  =0;
                  var Descuento =0;
                  var imp_tras  =0.00;
                  var imp_ret   =0.00;
                  var Total     =0.00;
                  var impuesto_unitario = 0.00;
                  var tipo_impuesto = "<?php echo $tipo_impuesto; ?>";
                  var tasa_cuota = parseFloat("<?php echo $tasa_cuota; ?>");
                  for (var i = 1; i < cont; i++) {
                    //alert(parseFloat(document.getElementById('importe'+i).value.replace(',',''))+' - '+parseFloat(document.getElementById('quantity'+i).value.replace(',',''))+' - '+tasa_cuota);
                    subtotal = subtotal + parseFloat(document.getElementById('importe'+i).value.replace(',',''));
                    Descuento= Descuento+ parseFloat(document.getElementById('Descuento'+i).value.replace(',',''));
                    if (tipo_impuesto == '1') {
                      imp_tras = imp_tras + ((parseFloat(document.getElementById('unitario'+i).value.replace(',',''))*parseFloat(document.getElementById('quantity'+i).value.replace(',','')))*tasa_cuota);
                    }
                    if (tipo_impuesto == '2') {
                      imp_ret = imp_ret + ((parseFloat(document.getElementById('unitario'+i).value.replace(',',''))*parseFloat(document.getElementById('quantity'+i).value.replace(',','')))*tasa_cuota);
                      
                    }
                  }
                  Total = Total + imp_ret +imp_tras + subtotal - Descuento;
                  document.getElementById("SubTotal").value    = format2(subtotal);
                  document.getElementById("Descuento").value   = format2(Descuento);
                  document.getElementById("Retenidos").value   = format2(imp_ret);
                  document.getElementById("Trasladados").value = format2(imp_tras);
                  document.getElementById("Total").value = format2(Total);
                  document.getElementById("impuesto_unitario").value = format2(Total);

                function actualizatotal(cantidadInicial,num,preciou,descuento){
                  var id_concepto = 'quantity'+num; 
                  var SubTotal    = document.getElementById('SubTotal').value;
                  var Descuento   = document.getElementById('Descuento').value;
                  var Retenidos   = document.getElementById('Retenidos').value;
                  var Trasladados = document.getElementById('Trasladados').value;
                  var Total       = document.getElementById('Total').value;
                  var cantidad    = document.getElementById(id_concepto).value; 
                  if (/*cantidadInicial >= cantidad &&*/ cantidad != 0) {

                  document.getElementById(id_concepto).value = cantidad;
                  var SubTotales = 0;
                  var Descuentos = 0;
                  var RetenidosT = 0;
                  var TrasladosT = 0;
                  var TotalF     = 0;
                  var impuestounitarioR = 0;
                  var impuestounitarioT = 0;
                  if(Retenidos!=0.00){
                    impuestounitarioR=parseFloat(Retenidos.replace(',',''))/parseFloat(SubTotal.replace(',',''));//porcentaje del impuesto
                  }
                  if (Trasladados != 0.0) {
                    impuestounitarioT=parseFloat(Trasladados.replace(',',''))/parseFloat(SubTotal.replace(',',''));//porcentaje del impuesto
                  }
                  var cont = parseFloat('<?php echo $cont; ?>');
                  
                  for (var i = 1; i < cont; i++) {

                    SubTotales = ((parseFloat(document.getElementById('unitario'+i).value.replace(',',''))*parseFloat(document.getElementById('quantity'+i).value))+SubTotales);
                    Descuentos = ((parseFloat(document.getElementById('Descuento'+i).value.replace(',',''))*parseFloat(document.getElementById('quantity'+i).value))+Descuentos);

                    if (Retenidos!=0.0) {
                      RetenidosT = ((parseFloat(document.getElementById('unitario'+i).value.replace(',',''))*parseFloat(document.getElementById('quantity'+i).value)*impuestounitarioR)+RetenidosT);
                    }
                    if(Trasladados!=0.0){
                      TrasladosT = (((parseFloat(document.getElementById('unitario'+i).value.replace(',',''))*parseFloat(document.getElementById('quantity'+i).value))*impuestounitarioT)+TrasladosT); 
                    }

                    document.getElementById('importe'+i).value  = format2(((parseFloat(document.getElementById('unitario'+i).value.replace(',',''))*parseFloat(document.getElementById('quantity'+i).value))));
                    document.getElementById('Descuento'+i).value  = format2(((parseFloat(document.getElementById('Descuento'+i).value.replace(',',''))*parseFloat(document.getElementById('quantity'+i).value))));
                  }

                    TotalF = SubTotales+RetenidosT+TrasladosT-Descuentos;
                  document.getElementById('SubTotal').value  = format2(SubTotales);
                  document.getElementById('Descuento').value = format2(Descuentos);
                  document.getElementById('Retenidos').value = format2(RetenidosT);
                  document.getElementById('Trasladados').value = format2(TrasladosT);
                  document.getElementById('Total').value = format2(TotalF);

                  //window.location.reload(true);
                  }
                  if(cantidadInicial < 0/*cantidad*/ || cantidad == '0'){
                    document.getElementById(id_concepto).value = cantidadInicial;
                    alert("La nueva cantidad no puede ser mayor a la cantidad original ni igual a cero (0).");
                    location.reload(true);
                  }

                }
                function format2(n) {
                    return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
                }
               </script>
  <!-- /.content-wrapper -->