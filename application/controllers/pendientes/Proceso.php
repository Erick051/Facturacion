<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proceso extends CI_Controller {

	/**
	 * Inicio de sesion
	 *
	 */
	public function index($sigPaso = 1)
	{
        switch( $sigPaso ){
            case 1:
               // antes de iniciar el proceso
               $this->antesIniciarProceso();
               break;
            
            case 2:
               // antes de iniciar el proceso
               $this->antesCadaRegistro();
               break;            
            case 3:
               // antes de iniciar el proceso
               $this->porCadaRegistro();
               break;
            case 4:
               // antes de iniciar el proceso
               $this->despuesCadaRegistro();
               break;
            case 5:
               // antes de iniciar el proceso
               $this->alTerminarProceso();
               break;
        }
    
	}
    
    public function antesIniciarProceso() {
        $urlSiguientePaso = base_url()."index.php/Proceso/index/2";
        $data["urlSiguientePaso"] = $urlSiguientePaso;
        $this->load->view("view_antesIniciarProceso", $data);
        
    }

    public function antesCadaRegistro() {
        $urlSiguientePaso = base_url()."index.php/Proceso/index/3";
        $data["urlSiguientePaso"] = $urlSiguientePaso;
        $this->load->view("view_antesCadaRegistro", $data);
    }

    public function porCadaRegistro() {
        $urlSiguientePaso = base_url()."index.php/Proceso/index/4";
        $data["urlSiguientePaso"] = $urlSiguientePaso;
        $this->load->view("view_porCadaRegistro", $data);
        
    }

    public function despuesCadaRegistro() {
        $urlSiguientePaso = base_url()."index.php/Proceso/index/5";
        $data["urlSiguientePaso"] = $urlSiguientePaso;
        $this->load->view("view_despuesCadaRegistro", $data);
        
    }

    public function alTerminarProceso() {
        $urlSiguientePaso = base_url()."index.php/Proceso/index/1";
        $data["urlSiguientePaso"] = $urlSiguientePaso;
        $this->load->view("view_alTerminarProceso", $data);
    }

    
}
