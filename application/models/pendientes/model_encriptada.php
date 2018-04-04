<?php

// modelo para administrar las cuentas de usuario

class model_encriptada extends CI_model {

  // obtiene la lista de usuarios del tipo de cuenta recibido por parametro
  public function f_obtener_todos($tipo_acceso = 1)
  {
    if ( $tipo_acceso == 1 ) {
        $encriptados = Model\Encriptada::all();
    } else {
        $this->load->model("custom/model_encriptada_custom");
        
        $encriptados = $this->model_encriptada_custom->f_obtener_todos();
    }      
    // se devuelve el arreglo con la lista de usuarios
    return $encriptados;
  }

}



?>