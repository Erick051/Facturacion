<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

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
        /*
$user = new Model\Jos_users();
$user->id              = 0;
$user->name            = "ivanvega";
$user->username        = "Ivan Sin Miedo";
$user->email           = "ivan_vega@stoconsulting.com";
$user->password        = "123456";
$user->usertype        = "VPD";
$user->block           = 0;
$user->sendEmail       = 0;
$user->registerDate    = date("Y-m-d");
$user->lastvisitDate   = date("Y-m-d");
$user->activation      = date("Y-m-d");
$user->params          = "vpd";
$user->change_password = "2018-01-01";
$user->new_password    = 0;
$user->lastResetTime   = date("Y-m-d");
$user->resetCount      = 0;
$user->save();
        */
        // elegir usuario por id
        $someuser = Model\Jos_users::find(2096);
        error_log("aqui");
        $someuser->name = "Josue con miedo";
        $someuser->username = "josuegomez";
        $someuser->email = "josue_gomez@stoconsulting.com";
        ;
        
        if ( !$someuser->save())
        {
                echo 'Something wrong';
        }
        else
        {
                        // load all of our posts
                        $data['usuarios'] = Model\Jos_users::all();
                        
        
        
                        // build our blog table
                        $data['usuarios'] = $this->load->view('view_usuarios', $data, TRUE);
        
                        // show the main template
                        $this->load->view('view_listado_usuarios', $data);
        }
        

	}
}
