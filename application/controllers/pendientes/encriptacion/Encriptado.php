<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encriptado extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->model("model_encriptada");
        $encriptados = $this->model_encriptada->f_obtener_todos(2);
        
                // load all of our posts
                $data['encriptados'] = $encriptados;
                
                // show the main template
                $this->load->view('view_encriptados', $data);
	}
}
