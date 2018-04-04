<?php

// modelo para gestionar la conciliacion de tickets

class model_tickets_conciliacion extends CI_model {

  // realiza la consulta de la conciliacion automatica
  public function conciliacion_automatica($ship_from, $mes, $ano)
  {
    // se calculan las fechas
    $mes_formateado = $mes;
    if ( $mes_formateado < 10 ) {
        $mes_formateado = "0".$mes_formateado;
    }
    $fecha_inicio = $ano.$mes_formateado."01";
    $fecha_fin = $ano.$mes_formateado."31";
    
    switch($mes) {
        case 1:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
          
        case 2:
          $fecha_fin = $ano.$mes_formateado."29";
          break;        
        
        case 3:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 4:
          $fecha_fin = $ano.$mes_formateado."30";
          break;
          
        case 5:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 6:
          $fecha_fin = $ano.$mes_formateado."30";
          break;
        
        case 7:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 8:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 9:
          $fecha_fin = $ano.$mes_formateado."30";
          break;
        
        case 10:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 11:
          $fecha_fin = $ano.$mes_formateado."30";
          break;
        
        case 12:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
    }
      
    // facturas manuales que coinciden con un ticket
    $ls_sql = ' select trxa.customer_trx_id ctidmanual,
                       trxa.trx_number trxnmanual,
                       flx.flex_tp_id fidman,
                       flx.value fxvman,
                       trxa.needs_confirm nconfman,
                       concat(trxa.ship_from,flx.value) as ticketmanual,
                       jec.rfc_emisor,
                       jec.serie,
                       jec.folio,
                       jec.rfc rfc_receptor,
                       jec.nombre nombre_receptor,
                       jec.total,
                       jec.fechatimbrado,
                       trx2.customer_trx_id ctidticket,
                       trx2.trx_number trxnticket,
                       trx2.needs_confirm nconfticket
                from jos_ra_customer_trx_all trxa inner join jos_ra_flex flx
                     on trxa.customer_trx_id = flx.customer_trx_id
                     and flx.flex_tp_id = 21
                inner join jos_ra_customer_trx_all trx2
                     on concat(trxa.ship_from,flx.value) = trx2.trx_number
                     and trx2.ship_from = '.$ship_from.'
                     and trx2.needs_confirm = 1
                inner join jos_efactura_cache jec
                     on trxa.customer_trx_id = jec.customer_trx_id
                where trxa.ship_from = '.$ship_from.' 
                and   trxa.trx_number like "%R" 
                and   cast(trxa.fecha_pedido as date) between "'.$fecha_inicio.'" and "'.$fecha_fin.'"';

    $result_facturas = $this->db->query($ls_sql);

    // se inicia el contador de facturas
    $num_facturas = 1;
    
    $arr_facturas = array();
    
    // se obtienen los datos de cada plantel encontrado
    foreach ( $result_facturas->result() as $unaFactura)
    {
    
      $arr_facturas[$num_facturas] = array("ctidmanual"       => $unaFactura->ctidmanual     ,
                                           "trxnmanual"       => $unaFactura->trxnmanual     ,
                                           "fidman"           => $unaFactura->fidman         ,
                                           "fxvman"           => $unaFactura->fxvman         ,
                                           "nconfman"         => $unaFactura->nconfman       ,
                                           "ticketmanual"     => $unaFactura->ticketmanual   ,
                                           "rfc_emisor"       => $unaFactura->rfc_emisor     ,
                                           "serie"            => $unaFactura->serie          ,
                                           "folio"            => $unaFactura->folio          ,
                                           "rfc_receptor"     => $unaFactura->rfc_receptor   ,
                                           "nombre_receptor"  => $unaFactura->nombre_receptor,
                                           "total"            => $unaFactura->total          ,
                                           "fechatimbrado"    => $unaFactura->fechatimbrado  ,
                                           "ctidticket"       => $unaFactura->ctidticket     ,
										   "trxnticket"       => $unaFactura->trxnticket     ,
                                           "nconfticket"      => $unaFactura->nconfticket  
                                          );

      // se incrementa el contador
      $num_facturas++;
    }
    
    // se libera el cursor
    $result_facturas->free_result();
  
    // se devuelve el arreglo con la lista de facturas
    return $arr_facturas;
  }

  // obtener cifras para conciliacion
  public function obtener_cifras_conciliacion($ship_from, $mes, $ano)
  {
    // se calculan las fechas
    $mes_formateado = $mes;
    if ( $mes_formateado < 10 ) {
        $mes_formateado = "0".$mes_formateado;
    }
    $fecha_inicio = $ano.$mes_formateado."01";
    $fecha_fin = $ano.$mes_formateado."31";
    
    switch($mes) {
        case 1:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
          
        case 2:
          $fecha_fin = $ano.$mes_formateado."29";
          break;        
        
        case 3:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 4:
          $fecha_fin = $ano.$mes_formateado."30";
          break;
          
        case 5:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 6:
          $fecha_fin = $ano.$mes_formateado."30";
          break;
        
        case 7:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 8:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 9:
          $fecha_fin = $ano.$mes_formateado."30";
          break;
        
        case 10:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
        
        case 11:
          $fecha_fin = $ano.$mes_formateado."30";
          break;
        
        case 12:
          $fecha_fin = $ano.$mes_formateado."31";
          break;
    }
      
    // conteo de tickets facturados y no faturados
    $ls_sql = ' select trxa.needs_confirm, count(*) conteo
                from jos_ra_customer_trx_all trxa
                where trxa.ship_from = '.$ship_from.' 
                and   trxa.trx_number not like "%R" 
                and   cast(trxa.fecha_pedido as date) between "'.$fecha_inicio.'" and "'.$fecha_fin.'"
                and   trxa.needs_confirm between 0 and 2
                group by trxa.needs_confirm';

    $result_conteo_tickets = $this->db->query($ls_sql);

    $arr_cifras_conciliacion = array();
    
    // se obtienen los datos de cada plantel encontrado
    foreach ( $result_conteo_tickets->result() as $conteoTickets )
    {
        if ( $conteoTickets->needs_confirm == 1 ) {
            // sin facturar
            $arr_cifras_conciliacion["tickets_sin_factura"] = $conteoTickets->conteo;
        } else {
            // facturados (estatus 0 o 2 [cancelados por factura manual])
            $arr_cifras_conciliacion["tickets_facturados"] = $conteoTickets->conteo;
        }
        
    }
    
    // total de tickets (facturados menos )
    $arr_cifras_conciliacion["tickets_recibidos"] = $arr_cifras_conciliacion["tickets_sin_factura"] + $arr_cifras_conciliacion["tickets_facturados"];
    // se libera el cursor
    $result_conteo_tickets->free_result();
  
  
    // ------------------------- CONTEO DE FACTURAS MANUALES
    // conteo de tickets facturados y no faturados
    $ls_sql = ' select count(*) conteo
                from   jos_ra_customer_trx_all trxa
                where  trxa.ship_from = '.$ship_from.' 
                and    trxa.trx_number like "%R" 
                and   cast(trxa.fecha_pedido as date) between "'.$fecha_inicio.'" and "'.$fecha_fin.'"
                and   trxa.needs_confirm = 0';

    $result_conteo_tickets = $this->db->query($ls_sql);
    
    // se obtienen los datos de cada plantel encontrado
    foreach ( $result_conteo_tickets->result() as $conteoFacturas )
    {
        $arr_cifras_conciliacion["facturas_manuales"] = $conteoFacturas->conteo;
    }
    
    // se libera el cursor
    $result_conteo_tickets->free_result();
    
    // se devuelve el arreglo con las cifras de conciliacion
    return $arr_cifras_conciliacion;
  }
}



?>