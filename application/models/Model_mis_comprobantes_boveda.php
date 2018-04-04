<?php

// modelo para buscar las transacciones para facturar

class model_mis_comprobantes_boveda extends CI_model {

  // listado de entidades segun el tipo de entidad ORGANIZATION, CUSTOMER, SUCURSAL, ETC
  public function buscar_comprobantes($tipo_ejecucion, $tipo_usuario, $where_rfcs_emisor, $rfc_emisor, $nombre_emisor, $rfc_receptor, $nombre_receptor, $pais_residencia, $num_reg_id_trib, $serie, $folio_inicio, $folio_fin, $uuid, $fecha_emision_desde,
   $fecha_emision_hasta, $fecha_timbrado_desde, $fecha_timbrado_hasta, $moneda, $monto_desde, $monto_hasta, $tipo_comprobante, $concepto, $clave_prod_serv)
  {

      // si se solicito conteo
      $select_conteo  = " select count(*) as conteo from v_pss_listado_comprobantes_boveda where ";
      $select_transaccion  = " select * from v_pss_listado_comprobantes_boveda where ";
          
      // si es el administrador, puede ver todo
      if ( $tipo_usuario == PERFIL_USUARIO_ADMON_STO || $tipo_usuario == PERFIL_USUARIO_ADMON_PORTAL || $tipo_usuario == PERFIL_USUARIO_OPERADOR ) {
          $clausulas = " 1 = 1 ";
      } else {
          $clausulas = $where_rfcs_emisor;
      }
                                 
      // se prepara el query de consulta
      // si se tiene emisor
      if ( $rfc_emisor != null && $rfc_emisor != "" ) {
          $like_emisor = " and rfc_emisor like '%".$rfc_emisor."%'";
          $clausulas .= $like_emisor;
      }
      
      if ( $nombre_emisor != null && $nombre_emisor != "" ) {
          $like_nombre_emisor = " and nombre_emisor like '%".$nombre_emisor."%'";
          $clausulas .= $like_nombre_emisor;
      }
      
      // si se tiene receptor
      if ( $rfc_receptor != null && $rfc_receptor != "" ) {
          $like_receptor = " and rfc_receptor like '%".$rfc_receptor."%'";
          $clausulas .= $like_receptor;
      }
      
      if ( $nombre_receptor != null && $nombre_receptor != "" ) {
          $like_nombre_receptor = " and nombre_receptor like '%".$nombre_receptor."%'";
          $clausulas .= $like_nombre_receptor;
      }
      
      if ( $pais_residencia != null && $pais_residencia != "---" ) {
          $like_pais_residencia = " and pais_residencia like '%".$pais_residencia."%'";
          $clausulas .= $like_pais_residencia;
      }
      
      if ( $num_reg_id_trib != null && $num_reg_id_trib != "" ) {
          $like_num_reg_id_trib = " and num_reg_id_trib like '%".$num_reg_id_trib."%'";
          $clausulas .= $like_num_reg_id_trib;
      }
      
      // si se tiene serie y rango de folios
      if ( $serie != null && $serie != "" ) {
          $like_serie = " and serie like '%".$serie."%'";
          $clausulas .= $like_serie;
      }
      
      if ( $folio_inicio != null && $folio_inicio != "" && $folio_fin != null && $folio_fin != "") {
          $like_folio = " and folio between ".$folio_inicio." AND ".$folio_fin." ";
          $clausulas .= $like_folio;
      }
      
      // si se tiene uuid
      if ( $uuid != null && $uuid != "" ) {
          $like_uuid = " and uuid like '%".$uuid."%'";
          $clausulas .= $like_uuid;
      }
      
      // si se tiene rango de fechas de emision
      if ( $fecha_emision_desde != null && $fecha_emision_desde != "" && $fecha_emision_hasta != null && $fecha_emision_hasta != "") {
          $like_fecha_emision = " and fecha_emision between '".$fecha_emision_desde."' AND '".$fecha_emision_hasta."'";
          $clausulas .= $like_fecha_emision;
      }
      
      // si se tiene rango de fechas de timbrado
      if ( $fecha_timbrado_desde != null && $fecha_timbrado_desde != "" && $fecha_timbrado_hasta != null && $fecha_timbrado_hasta != "") {
          $like_fecha_timbrado = " and fecha_timbrado between '".$fecha_timbrado_desde."' AND '".$fecha_timbrado_hasta."'";
          $clausulas .= $like_fecha_timbrado;
      }
      
      // si se tiene moneda
      if ( $moneda != null && $moneda != "" ) {
          $like_moneda = " and moneda like '%".$moneda."%'";
          $clausulas .= $like_moneda;
      }
      
      // rango de montos
      if ( $monto_desde != null && $monto_desde != "" && $monto_hasta != null && $monto_hasta != "") {
          $like_monto = " and monto between ".$monto_desde." AND ".$monto_hasta;
          $clausulas .= $like_monto;
      }
      
      // si se tiene tipo de comprobante
      if ( $tipo_comprobante != null && $tipo_comprobante != "---" ) {
          $like_tipo = " and tipo_comprobante = '".$tipo_comprobante."'";
          $clausulas .= $like_tipo;
      }

    //echo "<br>Query: ".$busqueda_transaccion;
    //die();
    
    // se concatenan las clausulas de los filtros de consulta
    $busqueda_conteo      = $select_conteo.$clausulas;
    $busqueda_transaccion = $select_transaccion.$clausulas." order by fecha_timbrado DESC LIMIT 300";
    
    // se registra la consulta realizada
    $ultima_consulta = new Model\Pss_boveda_consulta_cfdi();
    $ultima_consulta->id_consulta          = 0;
    $ultima_consulta->id_usuario           = $id_usuario = $this->session->userdata("id_usuario");
    $ultima_consulta->fecha_consulta       = date("Y-m-d H:i:s");
    $ultima_consulta->ultima_consulta      = $busqueda_transaccion;
    $ultima_consulta->estatus_consulta     = 0; // pendiente
    $ultima_consulta->descripcion_estatus  = null;
    $ultima_consulta->url_descarga         = null;
    $ultima_consulta->notificar_por_correo = null;
    $ultima_consulta->correo_notificacion  = null;
    $ultima_consulta->save();
    
    // id de la consulta generada
    $id_consulta = Model\Pss_boveda_consulta_cfdi::last_created()->id_consulta;
    
    // si se pidio conteo
    if ( $tipo_ejecucion == 1 ) {
        $result_transaccion = $this->db->query($busqueda_conteo);
        
        $row = $result_transaccion->row();
        
        $conteo = $row->conteo;
        
        $respuesta_consulta = array();
        $respuesta_consulta["conteo"] = $conteo;
        $respuesta_consulta["id_consulta"] = $id_consulta;
        //die($busqueda_transaccion);
        return $respuesta_consulta;

    } else {
        
        $result_transaccion = $this->db->query($busqueda_transaccion);
        
        // se inicia el contador de transacciones
        $num_transacciones = 1;
        
        $arr_transacciones = array();
        
        // se obtienen los datos de cada transaccion
        foreach ( $result_transaccion->result() as $unaTransaccion)
        {
        
          $arr_transacciones[$num_transacciones] = array("id_docto"          => $unaTransaccion->id_docto          ,
                                                         "version"           => $unaTransaccion->version           ,
                                                         "rfc_emisor"        => $unaTransaccion->rfc_emisor        ,
                                                         "nombre_emisor"     => $unaTransaccion->nombre_emisor     ,
                                                         "rfc_receptor"      => $unaTransaccion->rfc_receptor      ,
                                                         "nombre_receptor"   => $unaTransaccion->nombre_receptor   ,
                                                         "pais_residencia"   => $unaTransaccion->pais_residencia   ,
                                                         "num_reg_id_trib"   => $unaTransaccion->num_reg_id_trib   ,
                                                         "serie"             => $unaTransaccion->serie             ,
                                                         "folio"             => $unaTransaccion->folio             ,
                                                         "uuid"              => $unaTransaccion->uuid              ,
                                                         "fecha_emision"     => $unaTransaccion->fecha_emision     ,
                                                         "fecha_timbrado"    => $unaTransaccion->fecha_timbrado    ,
                                                         "estatus"           => $unaTransaccion->estatus           ,
                                                         "fecha_cancelacion" => $unaTransaccion->fecha_cancelacion ,
                                                         "moneda"            => $unaTransaccion->moneda            ,
                                                         "tipo_cambio"       => $unaTransaccion->tipo_cambio       ,
                                                         "monto"             => $unaTransaccion->monto             ,
                                                         "tipo_comprobante"  => $unaTransaccion->tipo_comprobante  ,
                                                         "forma_pago"        => $unaTransaccion->forma_pago        ,
                                                         "metodo_pago"       => $unaTransaccion->metodo_pago       ,
                                                         "comentarios"       => $unaTransaccion->comentarios       
                                                         );
                                                         
          // se incrementa el contador
          $num_transacciones = $num_transacciones + 1;
        }
        
        // se libera el cursor
        $result_transaccion->free_result();
        
        $respuesta_consulta = array();
        
        $respuesta_consulta["arr_transacciones"] = $arr_transacciones;
        $respuesta_consulta["id_consulta"]       = $id_consulta;
        
        // se devuelve el arreglo con la lista de transacciones encontradas
        //die($busqueda_transaccion);
        return $respuesta_consulta;
    }
    
  
  }
  
  public function buscar_comprobantes_por_consulta($busqueda_transaccion)
  {

    $result_transaccion = $this->db->query($busqueda_transaccion);
    
    // se inicia el contador de transacciones
    $num_transacciones = 1;
    
    $arr_transacciones = array();
    
    // se obtienen los datos de cada transaccion
    foreach ( $result_transaccion->result() as $unaTransaccion)
    {
    
      $arr_transacciones[$num_transacciones] = array("id_docto"          => $unaTransaccion->id_docto          ,
                                                     "version"           => $unaTransaccion->version           ,
                                                     "rfc_emisor"        => $unaTransaccion->rfc_emisor        ,
                                                     "nombre_emisor"     => $unaTransaccion->nombre_emisor     ,
                                                     "rfc_receptor"      => $unaTransaccion->rfc_receptor      ,
                                                     "nombre_receptor"   => $unaTransaccion->nombre_receptor   ,
                                                     "pais_residencia"   => $unaTransaccion->pais_residencia   ,
                                                     "num_reg_id_trib"   => $unaTransaccion->num_reg_id_trib   ,
                                                     "serie"             => $unaTransaccion->serie             ,
                                                     "folio"             => $unaTransaccion->folio             ,
                                                     "uuid"              => $unaTransaccion->uuid              ,
                                                     "fecha_emision"     => $unaTransaccion->fecha_emision     ,
                                                     "fecha_timbrado"    => $unaTransaccion->fecha_timbrado    ,
                                                     "estatus"           => $unaTransaccion->estatus           ,
                                                     "fecha_cancelacion" => $unaTransaccion->fecha_cancelacion ,
                                                     "moneda"            => $unaTransaccion->moneda            ,
                                                     "tipo_cambio"       => $unaTransaccion->tipo_cambio       ,
                                                     "monto"             => $unaTransaccion->monto             ,
                                                     "tipo_comprobante"  => $unaTransaccion->tipo_comprobante  ,
                                                     "forma_pago"        => $unaTransaccion->forma_pago        ,
                                                     "metodo_pago"       => $unaTransaccion->metodo_pago       ,
                                                     "comentarios"       => $unaTransaccion->comentarios       
                                                     );
                                                     
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