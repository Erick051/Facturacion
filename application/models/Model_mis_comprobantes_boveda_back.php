<?php

// modelo para buscar las transacciones para facturar

class model_mis_comprobantes_boveda extends CI_model {

  // listado de entidades segun el tipo de entidad ORGANIZATION, CUSTOMER, SUCURSAL, ETC
  public function buscar_comprobantes($where_rfcs_emisor, $rfc_emisor, $nombre_emisor, $rfc_receptor, $nombre_receptor, $pais_residencia, $num_reg_id_trib, $serie, $folio_inicio, $folio_fin, $uuid, $fecha_emision_desde,
   $fecha_emision_hasta, $fecha_timbrado_desde, $fecha_timbrado_hasta, $moneda, $monto_desde, $monto_hasta, $tipo_comprobante, $concepto, $clave_prod_serv)
  {

      $busqueda_transaccion  = " select * from 
                                 V_pss_listado_comprobantes_boveda
                                 where ";
                                 
      $busqueda_transaccion .= $where_rfcs_emisor;

      // se prepara el query de consulta
      // si se tiene emisor
      if ( $rfc_emisor != null && $rfc_emisor != "" ) {
          $like_emisor = "rfc_emisor like '%".$rfc_emisor."%'";
          $busqueda_transaccion .= $like_emisor;
      }
      
      if ( $nombre_emisor != null && $nombre_emisor != "" ) {
          $like_nombre_emisor = "nombre_emisor like '%".$nombre_emisor."%'";
          $busqueda_transaccion .= $like_nombre_emisor;
      }
      
      // si se tiene receptor
      if ( $rfc_receptor != null && $rfc_receptor != "" ) {
          $like_receptor = "rfc_receptor like '%".$rfc_receptor."%'";
          $busqueda_transaccion .= $like_receptor;
      }
      
      if ( $nombre_receptor != null && $nombre_receptor != "" ) {
          $like_nombre_receptor = "nombre_receptor like '%".$nombre_receptor."%'";
          $busqueda_transaccion .= $like_nombre_receptor;
      }
      
      if ( $pais_residencia != null && $pais_residencia != "---" ) {
          $like_pais_residencia = "pais_residencia like '%".$pais_residencia."%'";
          $busqueda_transaccion .= $like_pais_residencia;
      }
      
      if ( $num_reg_id_trib != null && $num_reg_id_trib != "" ) {
          $like_num_reg_id_trib = "num_reg_id_trib like '%".$num_reg_id_trib."%'";
          $busqueda_transaccion .= $like_num_reg_id_trib;
      }
      
      // si se tiene serie y rango de folios
      if ( $serie != null && $serie != "" ) {
          $like_serie = "serie like '%".$serie."%'";
          $busqueda_transaccion .= $like_serie;
      }
      
      if ( $folio_inicio != null && $folio_inicio != "" && $folio_fin != null && $folio_fin != "") {
          $like_folio = "folio between ".$folio_inicio." AND ".$folio_fin."";
          $busqueda_transaccion .= $like_folio;
      }
      
      // si se tiene uuid
      if ( $uuid != null && $uuid != "" ) {
          $like_uuid = "uuid like '%".$uuid."%'";
          $busqueda_transaccion .= $like_uuid;
      }
      
      // si se tiene rango de fechas de emision
      if ( $fecha_emision_desde != null && $fecha_emision_desde != "" && $fecha_emision_hasta != null && $fecha_emision_hasta != "") {
          $like_fecha_emision = "fecha_emision between '".$fecha_emision_desde."' AND '".$fecha_emision_hasta."'";
          $busqueda_transaccion .= $like_fecha_emision;
      }
      
      // si se tiene rango de fechas de timbrado
      if ( $fecha_timbrado_desde != null && $fecha_timbrado_desde != "" && $fecha_timbrado_hasta != null && $fecha_timbrado_hasta != "") {
          $like_fecha_timbrado = "fecha_timbrado between '".$fecha_timbrado_desde."' AND '".$fecha_timbrado_hasta."'";
          $busqueda_transaccion .= $like_fecha_timbrado;
      }
      
      // si se tiene moneda
      if ( $moneda != null && $moneda != "" ) {
          $like_moneda = "moneda like '%".$moneda."%'";
          $busqueda_transaccion .= $like_moneda;
      }
      
      // rango de montos
      if ( $monto_desde != null && $monto_desde != "" && $monto_hasta != null && $monto_hasta != "") {
          $like_monto = "monto between '".$monto_desde."' AND '".$monto_hasta."'";
          $busqueda_transaccion .= $like_monto;
      }
      
      // si se tiene tipo de comprobante
      if ( $tipo_comprobante != null && $tipo_comprobante != "---" ) {
          $like_tipo = "tipo_comprobante = '".$tipo_comprobante."'";
          $busqueda_transaccion .= $like_tipo;
      }

    //echo "<br>Query: ".$busqueda_transaccion;
    //die();

    $result_transaccion = $this->db->query($busqueda_transaccion);

    // se inicia el contador de transacciones
    $num_transacciones = 1;
    
    $arr_transacciones = array();
    
    // se obtienen los datos de cada transaccion
    foreach ( $result_transaccion->result() as $unaTransaccion)
    {
    
      $arr_transacciones[$num_transacciones] = array("id_docto"          => $unaTransaccion->id_docto          ;
                                                     "version"           => $unaTransaccion->version           ;
                                                     "rfc_emisor"        => $unaTransaccion->rfc_emisor        ;
                                                     "nombre_emisor"     => $unaTransaccion->nombre_emisor     ;
                                                     "rfc_receptor"      => $unaTransaccion->rfc_receptor      ;
                                                     "nombre_receptor"   => $unaTransaccion->nombre_receptor   ;
                                                     "pais_residencia"   => $unaTransaccion->pais_residencia   ;
                                                     "num_reg_id_trib"   => $unaTransaccion->num_reg_id_trib   ;
                                                     "serie"             => $unaTransaccion->serie             ;
                                                     "folio"             => $unaTransaccion->folio             ;
                                                     "uuid"              => $unaTransaccion->uuid              ;
                                                     "fecha_emision"     => $unaTransaccion->fecha_emision     ;
                                                     "fecha_timbrado"    => $unaTransaccion->fecha_timbrado    ;
                                                     "estatus"           => $unaTransaccion->estatus           ;
                                                     "fecha_cancelacion" => $unaTransaccion->fecha_cancelacion ;
                                                     "moneda"            => $unaTransaccion->moneda            ;
                                                     "tipo_cambio"       => $unaTransaccion->tipo_cambio       ;
                                                     "monto"             => $unaTransaccion->monto             ;
                                                     "tipo_comprobante"  => $unaTransaccion->tipo_comprobante  ;
                                                     "forma_pago"        => $unaTransaccion->forma_pago        ;
                                                     "metodo_pago"       => $unaTransaccion->metodo_pago       ;
                                                     "comentarios"       => $unaTransaccion->comentarios       ;
                                                     
      // se incrementa el contador
      $num_transacciones = $num_transacciones + 1;
    }
    
    // se libera el cursor
    $result_transaccion->free_result();
  
    // se devuelve el arreglo con la lista de transacciones encontradas
    return $arr_transacciones;
  }
  

}



?>