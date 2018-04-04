
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mi_perfil extends CI_Controller {

 function __construct() {
        parent::__construct();
        
        // si la sesion ya expiro, entonces se envia a la pagina de inicio para hacer login nuevamente
        $existe_sesion = $this->session->userdata("id_usuario");
        if ( empty( $existe_sesion ) ) {
            redirect(site_url(),'refresh');
        }

    }
    
	/**
	 * Inicio de sesion
	 *
	 */
	public function index() {
        
	    //$this->output->enable_profiler(TRUE);
        // se creal el arreglo para paso de parametros
        $data = array();
        
        // se obtienen los datos del usuario
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        
        // se obtiene la relacion de clientes asociados al usuario
        $arr_r_usuario_cliente = Model\Pss_r_usuario_cliente::find_by_id_usuario($pss_usuario->id_usuario_pss);
        
        // se obtienen los datos fiscales del usuario
        $arr_clientes = array();
        $i = 1;
        $ids_cliente = '';
        foreach ($arr_r_usuario_cliente as $usuario_cliente) {
            if($usuario_cliente->id_cliente!="" && $usuario_cliente->id_cliente!=" " && $usuario_cliente->id_cliente!=null){
                if($i == 1){
                    $ids_cliente .= $usuario_cliente->id_cliente;
                }
                else{
                    $ids_cliente .= ", ".$usuario_cliente->id_cliente;   
                }
            $i++;
            }
        }
        if ($ids_cliente!='') {
            ////$this->output->enable_profiler(TRUE);
            $this->db->WHERE("id_cliente IN (".$ids_cliente.")");
            $this->db->ORDER_BY("id_cliente DESC");

            $this->db->LIMIT(30);
            $cliente = Model\C_clientes::all();
            $i=1;
            foreach ($cliente as $clientes) {
                if ( $clientes != null ) {
                    // se agrega el cliente al arreglo de clientes
                    $arr_clientes[$i] = $clientes;
                    $i++;
                }
            }
        }
        $data["arr_clientes"] = $arr_clientes;
       
        // url para el controlador de validacion de inicio de sesion
        $url_editar_cuenta = base_url("index.php/mi_perfil/editar_datos_cuenta");
        $url_editar_datos_fiscales = base_url("index.php/mi_perfil/editar_datos_fiscales");
        
        // pregunta de recuperacion usada
        $pregunta_recuperacion = Model\C_preguntas_recuperacion::find($pss_usuario->id_pregunta_recuperacion, false);
        $data["pregunta_recuperacion"] = $pregunta_recuperacion->pregunta;
        
        $url_busqueda_razon = base_url("index.php/Mi_perfil/busqueda_razon");
        $data["url_busqueda_razon"] = $url_busqueda_razon;   
        // url para recuperar la contrasena
        $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
        
        // se transfieren los parametros al arreglo
        $data["url_editar_cuenta"]           = $url_editar_cuenta;
        $data["url_editar_datos_fiscales"]   = $url_editar_datos_fiscales;
        $data["url_anterior"]                = $url_anterior;
        
        if ( $this->session->flashdata('titulo') != null ) {
          $data["titulo"]       = $this->session->flashdata('titulo');
          $data["mensaje"]      = $this->session->flashdata('mensaje');
          $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
        }
        cargar_interfaz_grafica($this, $data, 'mi_perfil/view_content_wrapper_consulta_datos_fiscales', null);

	}
    public function busqueda_razon($rfc_busqueda){

        $data = array();
        $url_busqueda_razon = base_url("index.php/Mi_perfil/busqueda_razon");
        $data["url_busqueda_razon"] = $url_busqueda_razon;  
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        $url_editar_cuenta = base_url("index.php/mi_perfil/editar_datos_cuenta");
        $url_editar_datos_fiscales = base_url("index.php/mi_perfil/editar_datos_fiscales");
        $data["url_editar_datos_fiscales"]   = $url_editar_datos_fiscales;
        // se obtiene la relacion de clientes asociados al usuario
        $arr_r_usuario_cliente = Model\Pss_r_usuario_cliente::find_by_id_usuario($pss_usuario->id_usuario_pss);
        
        $url_editar_cuenta = base_url("index.php/mi_perfil/editar_datos_cuenta");
        $data["url_editar_cuenta"]           = $url_editar_cuenta;
        $pregunta_recuperacion = Model\C_preguntas_recuperacion::find($pss_usuario->id_pregunta_recuperacion, false);
        $data["pregunta_recuperacion"] = $pregunta_recuperacion->pregunta;
        // se obtienen los datos fiscales del usuario
        $arr_clientes = array();
        $i = 1;
        $ids_cliente = '';
        foreach ($arr_r_usuario_cliente as $usuario_cliente) {
            if($usuario_cliente->id_cliente!="" && $usuario_cliente->id_cliente!=" " && $usuario_cliente->id_cliente!=null){
                if($i == 1){
                    $ids_cliente .= $usuario_cliente->id_cliente;
                }
                else{
                    $ids_cliente .= ", ".$usuario_cliente->id_cliente;   
                }
            $i++;
            }
        }
        if ($ids_cliente!='') {
            ////$this->output->enable_profiler(TRUE);
            $this->db->WHERE("id_cliente IN (".$ids_cliente.") AND rfc LIKE '%".$rfc_busqueda."%'");
            $this->db->ORDER_BY("id_cliente DESC");

            $this->db->LIMIT(100);
            $cliente = Model\C_clientes::all();
            $i=1;
            foreach ($cliente as $clientes) {
                if ( $clientes != null ) {
                    // se agrega el cliente al arreglo de clientes
                    $arr_clientes[$i] = $clientes;
                    $i++;
                }
            }
        }
        $data["arr_clientes"] = $arr_clientes;
        /*if ( !empty($arr_clientes) ) {
            $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
            $data["url_anterior"] = $url_anterior;
            
            $mensaje_error = "La consulta generada no regresa ningún resultado.";
            $data["mensaje_error"] = $mensaje_error;
            $url_login = base_url()."index.php/mi_perfil/index";
            redirect($url_login);
        }else{*/
        cargar_interfaz_grafica($this, $data, 'mi_perfil/busqueda_razon_social', null);
        
    }
    public function ajax_obtener_rfc($rfc) {
        // se asigna uso de utf en los nombres
        $this->db->simple_query("SET NAMES \'utf8\'");
        
        // se obtienen los datos del codigo postal
        
        $busqueda_rfc = Model\c_clientes::find_by_rfc($rfc);
        
        // se devuelve el arreglo en formato json
        $rfc_serch1 = array();
        $k='';
        foreach ($busqueda_rfc as $rfc) {
            $rfc_serch["cliente"] = $rfc->cliente;
            $rfc_serch["rfc"] = $rfc->rfc;
            $rfc_serch["numero_interior"]  = $rfc->numero_interior;
            $rfc_serch["numero_exterior"] = $rfc->numero_exterior;
            $rfc_serch["calle"] = $rfc->calle;
            $rfc_serch["colonia"] = $rfc->colonia;
            $rfc_serch["localidad"] = $rfc->localidad;
            $rfc_serch["municipio"] = $rfc->municipio;
            $rfc_serch["estado"] = $rfc->estado;
            $rfc_serch["pais"] = $rfc->pais;
            $rfc_serch["codigo_postal"] = $rfc->codigo_postal;
            $rfc_serch["email"] = $rfc->email;
            array_push($rfc_serch1, $rfc_serch);
            $k.=$rfc->rfc.' ';
        }
//die('iteraciones: '.$k);
        echo json_encode($rfc_serch1);
        
    }
    public function ajax_obtener_cat_cod_postal($cod_postal) {
        // se asigna uso de utf en los nombres
        $this->db->simple_query("SET NAMES \'utf8\'");
        
        // se obtienen los datos del codigo postal
        $this->db->where("d_codigo = ", $cod_postal);
        $this->db->order_by("d_asenta");
        $cat_cod_postales = Model\C_sepomex::all();
        
        // se devuelve el arreglo en formato json
        $codigos_postales = array();
        foreach ($cat_cod_postales as $cod_postal) {
            $cod_postales["d_codigo"] = $cod_postal->d_codigo;
            $cod_postales["d_asenta"] = $cod_postal->d_asenta;
            $cod_postales["d_mnpio"]  = $cod_postal->d_mnpio;
            $cod_postales["d_estado"] = $cod_postal->d_estado;
            $cod_postales["d_ciudad"] = $cod_postal->d_ciudad;
            array_push($codigos_postales, $cod_postales);
        }

        echo json_encode($codigos_postales);
        
    }
    
    public function obtener_cat_cod_postal($cod_postal) {
        // se asigna uso de utf en los nombres
        $this->db->simple_query("SET NAMES \'utf8\'");
        
        // se obtienen los datos del codigo postal
        $this->db->where("d_codigo = ", $cod_postal);
        $this->db->order_by("d_asenta");
        $cat_cod_postales = Model\C_sepomex::all();

        return $cat_cod_postales;
    }
    
    public function editar_datos_cuenta() {
        // se creal el arreglo para paso de parametros
        $data = array();
        
        // se obtienen los datos del usuario
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        
        // url para el controlador de validacion de inicio de sesion
        $url_registra_datos_cuenta = base_url("index.php/mi_perfil/registrar_datos_cuenta");
        
        // url para recuperar la contrasena
        $url_anterior = base_url("index.php/mi_perfil/index");

        // se obtienen las preguntas de recuperacion
        $this->db->where("estatus = 1");
        $arr_preguntas_recuperacion = Model\C_preguntas_recuperacion::all();
        $data["arr_preguntas_recuperacion"] = $arr_preguntas_recuperacion;
        
        // se transfieren los parametros al arreglo
        $data["url_registra_datos_cuenta"] = $url_registra_datos_cuenta;
        $data["url_anterior"]              = $url_anterior;
        
        
        if ( $this->session->flashdata('titulo') != null ) {
          $data["titulo"]       = $this->session->flashdata('titulo');
          $data["mensaje"]      = $this->session->flashdata('mensaje');
          $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
        }
        
        cargar_interfaz_grafica($this, $data, 'mi_perfil/view_content_wrapper_captura_datos_cuenta', null);
        
    }
    
    public function editar_datos_fiscales($id_cliente = null) {
        // se creal el arreglo para paso de parametros
        $data = array();
        
        // se obtienen los datos del usuario
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        
        // se obtienen los datos fiscales del usuario
        if ( $id_cliente != null ) {
            $cliente = Model\C_clientes::find($id_cliente);
            $data["cliente"] = $cliente;
            
            // datos del codigo postal
            $arr_cod_postales = $this->obtener_cat_cod_postal($cliente->codigo_postal);
            $data["arr_cod_postales"] = $arr_cod_postales;
        }
       
        // url para el controlador de validacion de inicio de sesion
        $url_registra_datos_fiscales = base_url("index.php/mi_perfil/registrar_datos_fiscales");
        
        // url para recuperar la contrasena
        $url_anterior = base_url("index.php/mi_perfil/index");
        
        // se transfieren los parametros al arreglo
        $data["url_registra_datos_fiscales"] = $url_registra_datos_fiscales;
        $data["url_anterior"]                = $url_anterior;
        
        
        // url de la funcion ajax para consulta de codigos postales
        $url_ajax_cat_cp = base_url()."index.php/mi_perfil/ajax_obtener_cat_cod_postal/";
        $data["url_ajax_cat_cp"] = $url_ajax_cat_cp;
        // url de la funcion ajax para consulta de rfc
        $url_ajax_rfc = base_url()."index.php/mi_perfil/ajax_obtener_rfc/";
        $data["url_ajax_rfc"] = $url_ajax_rfc;
        if ( $this->session->flashdata('titulo') != null ) {
          $data["titulo"]       = $this->session->flashdata('titulo');
          $data["mensaje"]      = $this->session->flashdata('mensaje');
          $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
        }
        
        // si es cliente nuevo
        if ( $id_cliente == null ) {
            cargar_interfaz_grafica($this, $data, 'mi_perfil/view_content_wrapper_captura_datos_fiscales_nuevo', "mi_perfil/view_script_captura_datos_fiscales");
        } else {
            // cliente existente
            cargar_interfaz_grafica($this, $data, 'mi_perfil/view_content_wrapper_captura_datos_fiscales', "mi_perfil/view_script_captura_datos_fiscales");
        }
        
        
    }
    
    public function registrar_datos_cuenta() {
        // se obtienen los datos del formulario de captura
        $nombre                          = $this->input->post("nombre");
        $apellido_paterno                = $this->input->post("apellido_paterno");
        $apellido_materno                = $this->input->post("apellido_materno");
        $email_contacto                  = $this->input->post("email_contacto");
        $id_pista_recuperar_contrasena   = $this->input->post("id_pista_recuperar_contrasena");
        $respuesta_recuperar_contrasena  = $this->input->post("respuesta_recuperar_contrasena");
        
        // se validan los campos
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido_paterno', 'Apellido paterno', 'required');
        $this->form_validation->set_rules('email_contacto', 'Email de contacto', 'required');
        $this->form_validation->set_rules('respuesta_recuperar_contrasena', 'Respesta para recuperar la contraseña', 'required');

        
        // si las validaciones son correctas
        if ( $this->form_validation->run() == true ) {
            
            // se busca el registro de usuario
            $usuario_pss = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
            // se reasignan los datos
            $usuario_pss->nombre                           = strtoupper($nombre);
            $usuario_pss->apellido_paterno                 = strtoupper($apellido_paterno);
            $usuario_pss->apellido_materno                 = strtoupper($apellido_materno);
            $usuario_pss->email                            = $email_contacto;
            $usuario_pss->id_pregunta_recuperacion         = $id_pista_recuperar_contrasena;
            $usuario_pss->respuesta_recuperar_contrasena   = $respuesta_recuperar_contrasena;
            $usuario_pss->fecha_alta                       = date("y-m-d");
            $usuario_pss->dir_ip                           = $this->input->ip_address();
            $usuario_pss->save();
        
            $this->session->set_flashdata('titulo', "Datos de cuenta");
            $this->session->set_flashdata('mensaje', "Sus datos han sido actualizados correctamente");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
		    $url_login = base_url()."index.php/mi_perfil/index";
            redirect($url_login);
            
        } else {
            // se redirige a la consulta
            $this->session->set_flashdata('titulo', "Datos de cuenta");
            $mensaje = "Por favor verifique los datos que capturó para su cuenta:<br>".validation_errors();
            $this->session->set_flashdata('mensaje', $mensaje);
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

		    $url_login = base_url()."index.php/mi_perfil/index";
            redirect($url_login);
        }
        


        
    }
    
    public function registrar_datos_fiscales() {
        // se obtienen los datos del formulario de captura
        $id_cliente                      = strtoupper($this->input->post("id_cliente"));
        $rfc                             = strtoupper($this->input->post("rfc"));
        $num_reg_id_trib                 = $this->input->post("num_reg_id_trib");
        $razon_social                    = strtoupper($this->input->post("cliente"));
        $email                           = $this->input->post("email");
        $email_confirma                  = $this->input->post("email_confirma");
        $calle                           = strtoupper($this->input->post("calle"));
        $num_exterior                    = $this->input->post("num_exterior");
        $num_interior                    = $this->input->post("num_interior");
        $cp                              = $this->input->post("cp");
        $colonia                         = strtoupper($this->input->post("colonia"));
        die($colonia);
        $municipio                       = strtoupper($this->input->post("municipio"));
        $localidad                       = strtoupper($this->input->post("localidad"));
        $estado                          = strtoupper($this->input->post("estado"));
        $pais                            = $this->input->post("pais");
        if ($colonia=='-1') {
            $colonia='';
        }
        if ($municipio=='-1') {
            $municipio='';
        }
        if ($localidad=='-1') {
            $localidad='';
        }
        if ($estado=='-1') {
            $estado='';
        }
        // si las validaciones son correctas
        if ( true ) {
            
            if ( $id_cliente == null || $id_cliente == "" ) {
                $cliente = new Model\C_clientes();
            } else {
                // se obtiene los datos fiscales
                $cliente = Model\C_clientes::find($id_cliente);
            }
            
            $cliente->cliente           = $razon_social;
            $cliente->rfc               = $rfc;
            $cliente->numero_exterior   = $num_exterior;
            $cliente->numero_interior   = $num_interior;
            $cliente->calle             = $calle;
            $cliente->colonia           = $colonia;
            $cliente->localidad         = $localidad;
            $cliente->referencia        = "";
            $cliente->municipio         = $municipio;
            $cliente->estado            = $estado;
            $cliente->pais              = $pais;
            $cliente->codigo_postal     = $cp;
            $cliente->email             = $email;
            $cliente->estatus           = 1;
            $cliente->num_reg_id_trib   = $num_reg_id_trib;
            $cliente->save();
            
            // si el cliente es nuevo, se asocia a la cuenta de usuario
            if ( $id_cliente == null || $id_cliente == "" ) {
                $id_cliente_nuevo = Model\C_clientes::last_created()->id_cliente;
                
                $pss_r_usuario_cliente = new Model\Pss_r_usuario_cliente();
                $pss_r_usuario_cliente->id_usuario = $this->session->userdata("id_usuario");
                $pss_r_usuario_cliente->id_cliente = $id_cliente_nuevo;
                $pss_r_usuario_cliente->fecha_alta = date("Ymd");
                $pss_r_usuario_cliente->save();
            }
            
            $this->session->set_flashdata('titulo', "Datos fiscales");
            $this->session->set_flashdata('mensaje', "Sus datos han sido actualizados correctamente");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
		    $url_login = base_url()."index.php/mi_perfil/index";
            redirect($url_login);
            
        } else {
            $this->session->set_flashdata('titulo', "Datos fiscales");
            $this->session->set_flashdata('mensaje', "Ocurrión un error al actualizar sus datos. Intente más tarde nuevamente.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
		    $url_login = base_url()."index.php/mi_perfil/index";
            redirect($url_login);
        }
        


        
    }

}
