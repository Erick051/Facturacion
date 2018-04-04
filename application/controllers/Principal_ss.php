<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal_ss extends CI_Controller {

 function __construct() {
        parent::__construct();
        
        // si la sesion ya expiro, entonces se envia a la pagina de inicio para hacer login nuevamente
        
        $existe_sesion = $this->session->userdata("id_usuario");
        if ( empty( $existe_sesion ) ) {
            redirect(site_url(),'refresh');
            //echo "No se abrio la sesion";
        }
    }
	/**
	 * Inicio de sesion
	 *
	 */
	public function index()
	{    
        // se transfieren los parametros al arreglo
        $data = array();
        $data["porcentaje_avance"] = "90%";
        
        if ( $this->session->flashdata('titulo') != null ) {
          $data["titulo"]       = $this->session->flashdata('titulo');
          $data["mensaje"]      = $this->session->flashdata('mensaje');
          $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
        }
        
        $data["titulo_pantalla_principal"] = $this->session->userdata("titulo_pantalla_principal");
        $config_portal          = $this->db->query("SELECT aviso_principal FROM pss_config_portal");
        $data["config_portal"]  = $config_portal->row();
        cargar_interfaz_grafica($this, $data, 'principal/view_content_wrapper_pantalla_principal', null);

	}
}
