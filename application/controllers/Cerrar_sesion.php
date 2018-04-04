<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cerrar_sesion extends CI_Controller {

	/**
	 * Cierre de sesion
	 *
	 */
	public function index()
	{
      // registra evento en bitacora
      //registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), CIERRE_DE_SESION);
    
      // se cierra la sesion
      $this->session->sess_destroy();      
    
      // se envia al usuario a la pantalla de inicio
      $this->session->set_flashdata('titulo', "Portal de autoservicio");
      $this->session->set_flashdata('mensaje', "Su sesión ha sido finalizada correctamente. Gracias por su visita");
      $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
      $url_login = base_url()."index.php/Login/index";
      redirect($url_login);
    
	}
}
