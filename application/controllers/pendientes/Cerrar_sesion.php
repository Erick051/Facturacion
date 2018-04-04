<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cerrar_sesion extends CI_Controller {

	/**
	 * Cierre de sesion
	 *
	 */
	public function index()
	{   
      // se finaliza la sesion
      $this->session->sess_destroy();
    
      // se envia al usuario a la pantalla de inicio
      $url_login = base_url()."index.php/Login/index";
      redirect($url_login);
    
	}
}
