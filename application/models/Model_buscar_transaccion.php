<?php

// modelo para buscar las transacciones para facturar

class model_buscar_transaccion extends CI_model {

  // listado de entidades segun el tipo de entidad ORGANIZATION, CUSTOMER, SUCURSAL, ETC
  public function obtener_idtrx33_transaccion($arr_campos, $id_entidad)
  {
      // se verifica si el id_entidad recibido es una matriz o una sucursal
      $sql_id_tipo_entidad = "select id_tipo_entidad from c_entidades where id_entidad = ".$id_entidad;
      $result_tipo_entidad = $this->db->query($sql_id_tipo_entidad);
      $row_entidad = $result_tipo_entidad->row();
      
      $id_tipo_entidad = $row_entidad->id_tipo_entidad;
      
      $busqueda_transaccion  = " select distinct emi.id_emisor, adic.id_trx33 from emi_trx33_inf_adic adic 
                                 inner join emi_trx33_r emi
                                     on adic.id_trx33 = emi.id_trx33_r
                                 where ";
                                 
      // si es la matriz
      if ( $id_tipo_entidad == 1 ) {
          $busqueda_transaccion .= " emi.id_emisor = ".$id_entidad;
      } else {
          // es la sucursal
          $busqueda_transaccion .= " emi.id_sucursal = ".$id_entidad;
      }
      
      for ( $i = 1; $i <= count($arr_campos); $i++ ) {
          $busqueda_transaccion .= ' and adic.id_trx33 in (select id_trx33 from emi_trx33_inf_adic where id_flex_header = "'.$arr_campos[$i]["campo_adicional"].'" and valor = "'.$arr_campos[$i]["valor"].'")';
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
    
      $arr_transacciones[$num_transacciones] = array("id_emisor" => $unaTransaccion->id_emisor     ,
                                                     "id_trx33"  => $unaTransaccion->id_trx33      );

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