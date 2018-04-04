<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Inicio de sesion
	 *
	 */
	public function index()
	{
        
        // url para el controlador de validacion de inicio de sesion
        $url_valida_inicio_sesion = base_url("index.php/valida_inicio_sesion");
        
        // url para recuperar la contrasena
        $url_recuperar_contrasena = base_url("index.php/recuperar_contrasena");
        
        // se transfieren los parametros al arreglo
        $data = array();
        $data["url_valida_inicio_sesion"] = $url_valida_inicio_sesion;
        $data["url_recuperar_contrasena"] = $url_recuperar_contrasena;
        
        // se verifica si hubo un error al iniciar sesion
        if ( $this->session->flashdata('mensaje_error') != null) {
            $mensaje_error = $this->session->flashdata('mensaje_error');
            $data["mensaje_error"] = $mensaje_error;
        }
        
		$this->load->view('view_html_head');
        $this->load->view('view_login', $data);
        $this->load->view('view_script');
        $this->load->view('view_script_final_login');
        $this->load->view('view_body_html_cierre');
	}
    
	public function vpd()
	{
        
        echo "Esta es la funcion vpd";
	}
}
