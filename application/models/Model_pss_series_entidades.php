<?php

// modelo para obtener numeros de folios de seris

class model_pss_series_entidades extends CI_model {

  // folio de una serie
  public function obtener_folio($id_entidad, $serie)
  {
      $query_secuencia = "select secuencia from c_series_entidad where id_entidad = ".$id_entidad." and serie = '".$serie."'";

      
    //echo "<br>Query: ".$query_secuencia;
    //die();

    $result_secuencia = $this->db->query($query_secuencia);
    $secuencia = $result_secuencia->row();
    
    // se inserta el siguiente folio
    $nuevo_folio = "insert into ".$secuencia->secuencia." values (0)";
    $this->db->query($nuevo_folio);
    
    // se obtiene el folio insertado
    $folio = $this->db->insert_id();
    
    // se libera el cursor
    $result_secuencia->free_result();
  
    // se devuelve el arreglo con la lista de transacciones encontradas
    return $folio;
  }
  

}



?>