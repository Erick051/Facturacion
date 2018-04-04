<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Inicio de sesion
	 *
	 */
	public function index()
	{
        $data = array();
        
        // url para el controlador de validacion de inicio de sesion
        $url_valida_inicio_sesion = base_url("index.php/valida_inicio_sesion");
        
        // url para recuperar la contrasena
        $url_recuperar_contrasena = base_url("index.php/login/recuperar_contrasena");
        
        // url para crear cuenta nueva
        $url_crear_nueva_cuenta = base_url("index.php/login/crear_cuenta_nueva");
        // Si la contraseña es la misma con la que se dio de alta pide modificar contraseña
        $url_modificar_pass = base_url("index.php/login/modificar_pass");
        
        // se obtiene la configuracion del portal
        $config_portal = Model\Pss_config_portal::find(1, false);
        $data["config_portal"] = $config_portal;
        $tipo_usuario = Model\Pss_usuario::find_by_tipo_usuario("2");
        $data["tipo_usuario"] = $tipo_usuario;
        // se transfieren los parametros al arreglo
        $data["url_valida_inicio_sesion"] = $url_valida_inicio_sesion;
        $data["url_recuperar_contrasena"] = $url_recuperar_contrasena;
        $data["url_crear_nueva_cuenta"]  = $url_crear_nueva_cuenta;
        $data["url_modificar_pass"]  = $url_modificar_pass;
        
        // se verifica si hubo un error al iniciar sesion
        if ( $this->session->flashdata('titulo') != null ) {
          $data["titulo"]       = $this->session->flashdata('titulo');
          $data["mensaje"]      = $this->session->flashdata('mensaje');
          $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
        }
        
        cargar_interfaz_grafica_login($this, $data, "view_login", "view_script_final_login");
	}

   
  // ===============================================================================
  // Funcion que presenta formulario para capturar email/login para recuperar contrasena
  //
  // ====================================================
  public function recuperar_contrasena() {

    // se abre la ventana de con la pista para recuperar la contrasena
    $data = array();
    
    $data["url_valida_usuario_recuperar_contrasena"] = base_url()."/index.php/login/validar_login_recuperar_contrasena";
    $data["url_inicio"] = base_url();
    
    // si se recibio el mensaje de confirmacion se agrega a los datos pasados a la vista
    if ( $this->session->flashdata('titulo') != null ) {
      $data["titulo"]       = $this->session->flashdata('titulo');
      $data["mensaje"]      = $this->session->flashdata('mensaje');
      $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
    }
    
    // se obtiene la configuracion del portal
    $config_portal = Model\Pss_config_portal::find(1, false);
    $data["config_portal"] = $config_portal; 
    
    cargar_interfaz_grafica_login($this, $data, "view_recuperar_contrasena", "view_script_final_login");
  }
  
  
  // ===============================================================================
  // Funcion que valida el login o correo de un usuario para proceder a recuperar la contrasena
  //
  // ====================================================
  public function validar_login_recuperar_contrasena() {

    // datos del usuario
    $login_email = $this->input->post("login_email");
    
    // ---------------------- validacion de los datos --------------------------
    // se establecen las reglas de validacion
    $this->form_validation->set_rules("login_email","Login o email","required");
    
    // se verifican los datos recibidos
    if ( $this->form_validation->run() == FALSE )
    {
      // error en los datos
      $this->session->set_flashdata('titulo', "Error en los datos");
      $this->session->set_flashdata('mensaje', validation_errors());
      $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
      
      // se regresa al formulario de alta con los datos para que el usuario corrija      
      $this->recuperar_contrasena();
    }
    else
    {

      // si el login tecleado tiene una arroba se asume que es un correo
      if ( strpos($login_email, '@') !== false ) {
          // se tecleo email
          $usuario = Model\Pss_usuario::find_by_email($login_email, false);
          
          // si es arreglo regreso mas de un caso
          if ( is_array($usuario) ) {
              // no se localizo al usuario por email
              $this->session->set_flashdata('titulo', "Error en la identificación");
              $this->session->set_flashdata('mensaje', "Se encontró más de un usuario registrado con la dirección de correo tecleada [".$login_email."]. Intente de nuevo por favor con login o contacte a su administrador de sistema");
              $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
              
              // se regresa al formulario de alta con los datos para que el usuario corrija      
              $this->recuperar_contrasena();
              return;
              
          } else {
              // si no aparecio por email se obtiene el usuario
              if ( $usuario == null) {
                  // no se localizo al usuario por email
                  $this->session->set_flashdata('titulo', "Error en la identificación");
                  $this->session->set_flashdata('mensaje', "No se encontró un usuario registrado con la dirección de correo tecleada [".$login_email."]. Intente de nuevo por favor");
                  $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
                  
                  // se regresa al formulario de alta con los datos para que el usuario corrija      
                  $this->recuperar_contrasena();
                  return;
              }
              
          }
      } else {
          // se busca por login
          $usuario = Model\Pss_usuario::find_by_login($login_email, false);
          
          // si aparecio por email se obtiene el usuario
          if ( $usuario == null) {
              // no se localizo al usuario por email
              $this->session->set_flashdata('titulo', "Error en la identificación");
              $this->session->set_flashdata('mensaje', "No se encontró un usuario registrado con login [".$login_email."]. Intente de nuevo por favor");
              $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
              
              // se regresa al formulario de alta con los datos para que el usuario corrija      
              $this->recuperar_contrasena();
              return;
          }

      }
      
      // se registra intento de recuperacion de contrasena
      //registrar_evento_bitacora($this, $usuario->id_usuario, INICIA_RECUPERACION_DE_CONTRASENA);
      
      // se abre la ventana de con la pista para recuperar la contrasena
      $data = array();
      
      $data["usuario"] = $usuario;
      
      $data["url_valida_recuperacion_contrasena"] = base_url()."index.php/login/valida_recuperacion_contrasena";
      $data["url_inicio"] = base_url();
      
      $pregunta_recuperacion = Model\C_preguntas_recuperacion::find($usuario->id_pregunta_recuperacion);
      $data["pregunta_recuperacion"] = $pregunta_recuperacion;
      
      // se obtiene la configuracion del portal
      $config_portal = Model\Pss_config_portal::find(1, false);
      $data["config_portal"] = $config_portal;
      
      cargar_interfaz_grafica_login($this, $data, "view_recuperar_contrasena_pista", "view_script_final_login");
    }
  }
  
  // ===============================================================================
  // Funcion que valida la respuesta que dio el usuario a la pregunta para recuperar la contrasena. Si es correcta, regenerara la contrasena y le enviara un correo electronico con la misma
  // para que en el siguiente inicio de sesion el usuario la cambie
  // ====================================================
  public function valida_recuperacion_contrasena() {

    // datos del usuario
    $id_usuario = $this->input->post("id_usuario");
    $respuesta  = $this->input->post("respuesta");
    
    // ---------------------- validacion de los datos --------------------------
    // se establecen las reglas de validacion
    $this->form_validation->set_rules("respuesta","Respuesta a la pregunta de recuperación","required");
    
    // se verifican los datos recibidos
    if ( $this->form_validation->run() == FALSE )
    {
      // error en los datos
      $this->session->set_flashdata('titulo', "Error en los datos");
      $this->session->set_flashdata('mensaje', validation_errors());
      $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
      
      // se regresa al formulario de alta con los datos para que el usuario corrija      
      $this->recuperar_contrasena();
    }
    else
    {

      // se carga el usuario
      $usuario = Model\Pss_usuario::find($id_usuario);
          
      // si aparecio por email se obtiene el usuario
      if ( $usuario == null) {
          // no se localizo al usuario por email
          $this->session->set_flashdata('titulo', "Error en la identificación");
          $this->session->set_flashdata('mensaje', "No se encontró un usuario registrado con login [".$usuario->login."]. Intente de nuevo por favor");
          $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
          
          // se regresa al formulario de alta con los datos para que el usuario corrija      
          $this->recuperar_contrasena();
          return;
      }

      // se valida que la respuesta sea la capturada
      if ( strtoupper($respuesta) == strtoupper($usuario->respuesta_recuperar_contrasena) ) {
          // se asigna una contrasena generica
          $contrasena_generica = bin2hex(openssl_random_pseudo_bytes(7));
          $usuario->contrasena = MD5($contrasena_generica);
          $usuario->save();
          
          // se registra movimiento en bitacora
          //registrar_evento_bitacora($this, $id_usuario, RECUPERACION_DE_CONTRASENA_EXITOSO);
          
          ////$this->output->enable_profiler(TRUE);
          
          // se envia un correo al usuario
          //$this->db->where("es_default = 1");
          $remitente    = Model\Envio_correo_remitente::find_by_es_default(1, FALSE);
          $destinatario = new Model\Envio_correo_destinatario();
          $envio        = new Model\Envio_correo();
          
          // se obtiene la configuracion del portal
          $config_portal = Model\Pss_config_portal::find(1);
          
          // se llenan los datos para el envio de correo
          $envio->id_envio_correo  = 0;
          $envio->id_transaccion   = null;
          $envio->id_proceso       = null;
          $envio->id_remitente     = $remitente->id_remitente;
          $envio->procesado        = 0; // pendiente
          $envio->fecha_registro   = date("Y-m-d");
          $envio->fecha_proceso    = null;
          $envio->enviar_adjuntos  = 0;
          $envio->asunto           = $config_portal->titulo_pantalla_principal." - Recuperación de contraseña";
          
          $cuerpo_correo = "Su contraseña ha sido restablecida.\nPor favor entre al portal nuevamente haciendo clic aquí: ".base_url()." para cambiar su contraseña.\n\nLa contraseña temporal asignada es: ".$contrasena_generica;
          $envio->cuerpo           = $cuerpo_correo;
          
          $envio->save();
          
          // se obtiene el id de envio
          $id_envio = Model\Envio_correo::last_created()->id_envio_correo;
          // se asigna al registro
          $envio = Model\Envio_correo::find($id_envio);
          
          // se genera el registro del destinatario
          $destinatario->id_correo_destinatario = 0;
          $destinatario->id_envio_correo        = $id_envio;
          $destinatario->destinatario           = $usuario->email;
          $destinatario->fecha_proceso          = null;
          $destinatario->estatus_envio          = 1;
          $destinatario->cod_error              = null;
          $destinatario->d_error                = null;
          $destinatario->num_intentos           = 0;
          $destinatario->save();
          
          // se actualiza el registro de envio para que el ejecutor de envio lo considere
          $envio->procesado = 1; // listo para enviar
          $envio->save();
          
          // se abre la confirmacion de cambio de contrasena
          $url_confirmacion = base_url()."index.php/login/confirmacion_recuperar_contrasena";
          redirect($url_confirmacion);
      } else {
          // no coincide la respuesta
          $this->session->set_flashdata('titulo', "Error en la identificación");
          $this->session->set_flashdata('mensaje', "La respuesta tecleada no coincide con la que registró con su cuenta. Intente nuevamente o comuníquese con el administrador.");
          $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
          
          // se registra movimiento en bitacora
          //registrar_evento_bitacora($this, $id_usuario, ERROR_EN_RECUPERACION_DE_CONTRASENA);
          
          // se regresa al formulario de alta con los datos para que el usuario corrija      
          $this->recuperar_contrasena();
          return;
      }
    }
  }
    
  // ===============================================================================
  // Funcion que muestra la pantalla de confirmacion de recuperacion de contrasena
  // 
  // ====================================================
  public function confirmacion_recuperar_contrasena() {
      $data = array();
      $data["url_inicio"] = base_url();
        
      // se obtiene la configuracion del portal
      $config_portal = Model\Pss_config_portal::find(1, false);
      $data["config_portal"] = $config_portal;
        
      cargar_interfaz_grafica_login($this, $data, "view_recuperar_contrasena_confirmacion", "view_script_final_login");
      
      /*
      $this->load->view('login/view_html_head', $data);
      $this->load->view('login/view_recuperar_contrasena_confirmacion', $data);
      $this->load->view('login/view_script');
      $this->load->view('login/view_script_final_login');
      $this->load->view('login/view_body_html_cierre');
      */
    }

	public function crear_cuenta_nueva($rfc = null)
	{
        $data = array();
        
        // RFC tecleado en login
        $data["RFC"] = $rfc;
        
        // url para el controlador de validacion de inicio de sesion
        $url_nuevo_usuario = base_url("index.php/login/nuevo_usuario");
        
        // url para recuperar la contrasena
        $url_anterior = base_url("index.php/login/index");
        
        // se obtiene la configuracion del portal
        $config_portal = Model\Pss_config_portal::find(1, false);
        $data["config_portal"] = $config_portal;
        
        // se transfieren los parametros al arreglo
        $data["url_nuevo_usuario"] = $url_nuevo_usuario;
        $data["url_anterior"]      = $url_anterior;
        
        // preguntas de recuperacion
        $arr_preguntas_recuperacion = Model\C_preguntas_recuperacion::all();
        $data["arr_preguntas_recuperacion"] = $arr_preguntas_recuperacion;
        
        // se verifica si hubo un error al iniciar sesion
        if ( $this->session->flashdata('titulo') != null ) {
          $data["titulo"]       = $this->session->flashdata('titulo');
          $data["mensaje"]      = $this->session->flashdata('mensaje');
          $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
        }
        
        cargar_interfaz_grafica_login($this, $data, "view_autoregistro", "view_script_final_login");
	}
    
    public function nuevo_usuario() {
        ////$this->output->enable_profiler(TRUE);
        // datos de la cuenta de usuario
        $nombre                           = strtoupper($this->input->post("nombre"));
        $apellido_paterno                 = strtoupper($this->input->post("apellido_paterno"));
        $apellido_materno                 = strtoupper($this->input->post("apellido_materno"));
        $login                            = $this->input->post("login");
        $contrasena                       = $this->input->post("contrasena");
        $confirmar_contrasena             = $this->input->post("confirmar_contrasena");
        $email                            = $this->input->post("email");
        $id_pregunta_recuperacion         = $this->input->post("id_pregunta_recuperacion");
        $respuesta_recuperar_contrasena   = $this->input->post("respuesta_recuperar_contrasena");
        
        $chk_login = Model\Pss_usuario::find_by_login($login);
        if ($chk_login!=null) {//si el login ingresado  ya fue utilizado
          echo '<script> alert("Login de usuario '.$login.' ya existe. Favor de intentar con otro Login."); stop(); window.history.back(); </script>';
        }
        // si los datos son correctos
        if ( true ) {
            $nuevo_usuario = new Model\Pss_usuario();

            // se asignan los datos al objeto de usuario
            $nuevo_usuario->id_usuario_pss                   = 0                              ;
            $nuevo_usuario->nombre                           = $nombre                        ;
            $nuevo_usuario->apellido_paterno                 = $apellido_paterno              ;
            $nuevo_usuario->apellido_materno                 = $apellido_materno              ;
            $nuevo_usuario->login                            = $login                         ;
            $nuevo_usuario->contrasena                       = Md5($contrasena)               ;
            $nuevo_usuario->email                            = $email                         ;
            $nuevo_usuario->id_pregunta_recuperacion         = $id_pregunta_recuperacion      ;
            $nuevo_usuario->respuesta_recuperar_contrasena   = $respuesta_recuperar_contrasena;
            $nuevo_usuario->fecha_alta                       = date("Y-m-d h:i:s");
            $nuevo_usuario->fecha_ultima_sesion              = null;
            $nuevo_usuario->primer_inicio_sesion             = 1;
            $nuevo_usuario->solicitar_cambio_contrasena      = 0;
            $nuevo_usuario->id_estatus                       = 0;
            $nuevo_usuario->dir_ip                           = $this->input->ip_address();
            $nuevo_usuario->tipo_usuario                     = 4; // tipo cliente
            $nuevo_usuario->save();
            
            // se obtiene el id de usuario
            $id_usuario = Model\Pss_usuario::last_created()->id_usuario_pss;
            
            // registro de envio de correo para confirmacion de cuenta
            
            // envio de correo a STO
            
            // si el portal esta configurado a usar RFC como login
            $config_portal = Model\Pss_config_portal::find(1, false);
            
            if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
                // se obtienen los datos fiscales
                $rfc                             = strtoupper($this->input->post("rfc"));
                $num_reg_id_trib                 = $this->input->post("num_reg_id_trib");
                $razon_social                    = strtoupper($this->input->post("cliente"));
                $email_facturacion               = $this->input->post("email_facturacion");
                $email_confirma                  = $this->input->post("email_confirma");
                $calle                           = strtoupper($this->input->post("calle"));
                $num_exterior                    = $this->input->post("num_exterior");
                $num_interior                    = $this->input->post("num_interior");
                $cp                              = $this->input->post("cp");
                $colonia                         = strtoupper($this->input->post("colonia"));
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
                $cliente = new Model\C_clientes();

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
                $cliente->email             = $email_facturacion;
                $cliente->estatus           = 1;
                $cliente->num_reg_id_trib   = $num_reg_id_trib;
                $cliente->save();
                
                // se asocia a la cuenta de usuario
                $id_cliente_nuevo = Model\C_clientes::last_created()->id_cliente;
                
                $pss_r_usuario_cliente = new Model\Pss_r_usuario_cliente();
                $pss_r_usuario_cliente->id_usuario = $id_usuario;
                $pss_r_usuario_cliente->id_cliente = $id_cliente_nuevo;
                $pss_r_usuario_cliente->fecha_alta = date("Ymd");
                $pss_r_usuario_cliente->save();
            }

            // confirmacion de cuenta creada
            $this->session->set_flashdata('titulo', "Nuevo registro exitoso");
            $this->session->set_flashdata('mensaje', "Tu cuenta de usuario ha sido creada con éxito. Ya puedes hacer inicio de sesión.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
            
            $url_confirmacion = base_url()."index.php/valida_inicio_sesion/valida_inicio_sesion_login_rfc/".$id_usuario;
            redirect($url_confirmacion);
            
        } else {
            // confirmacion de cuenta creada
            $this->session->set_flashdata('titulo', "Error");
            $this->session->set_flashdata('mensaje', "Ocurrió un error al intentar crear tu cuenta de usuario. Por favor intenta nuevamente.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
            
            $url_confirmacion = base_url()."index.php/login";
            redirect($url_confirmacion);
            
        }
        
        
    }
    public function actualiza_usuario() {
        ////$this->output->enable_profiler(TRUE);
        // datos de la cuenta de usuario
        $nombre                           = $this->input->post("nombre");
        $apellido_paterno                 = $this->input->post("apellido_paterno");
        $apellido_materno                 = $this->input->post("apellido_materno");
        $login                            = $this->input->post("login");
        $contrasena                       = $this->input->post("contrasena_n");
        $confirmar_contrasena             = $this->input->post("confirmar_contrasena");
        $email                            = $this->input->post("email");
        $id_pregunta_recuperacion         = $this->input->post("id_pregunta_recuperacion");
        $respuesta_recuperar_contrasena   = $this->input->post("respuesta_recuperar_contrasena");
        
        // si los datos son correctos
        if ( true ) {
            
            $nuevo_usuario = Model\Pss_usuario::find_by_login($login);
            foreach ($nuevo_usuario as $nuevo_usuario) {
              
            // se obtienen los datos al objeto de usuario
                                          ;
            $nuevo_usuario->nombre                           = $nombre                        ;
            $nuevo_usuario->apellido_paterno                 = $apellido_paterno              ;
            $nuevo_usuario->apellido_materno                 = $apellido_materno              ;
            $nuevo_usuario->login                            = $login                         ;
            $nuevo_usuario->contrasena                       = Md5($contrasena)               ;
            $nuevo_usuario->email                            = $email                         ;
            $nuevo_usuario->id_pregunta_recuperacion         = $id_pregunta_recuperacion      ;
            $nuevo_usuario->respuesta_recuperar_contrasena   = $respuesta_recuperar_contrasena;
            $nuevo_usuario->fecha_alta                       = date("Y-m-d h:i:s");
            $nuevo_usuario->fecha_ultima_sesion              = null;
            $nuevo_usuario->primer_inicio_sesion             = 1;
            $nuevo_usuario->solicitar_cambio_contrasena      = 0;
            $nuevo_usuario->id_estatus                       = 0;
            $nuevo_usuario->dir_ip                           = $this->input->ip_address();
            $nuevo_usuario->tipo_usuario                     = 4; // cliente
            $nuevo_usuario->save();
            }
            // registro de envio de correo para confirmacion de cuenta
            
            // envio de correo a STO
            
            // confirmacion de cuenta creada
            $this->session->set_flashdata('titulo', "Actualización exitosa.");
            $this->session->set_flashdata('mensaje', "Tu cuenta de usuario ha sido modificada con éxito. Ya puedes hacer inicio de sesión.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
            
            $url_confirmacion = base_url()."index.php/login";
            redirect($url_confirmacion);
            
        } else {
            // confirmacion de cuenta creada
            $this->session->set_flashdata('titulo', "Error");
            $this->session->set_flashdata('mensaje', "Ocurrió un error al intentar crear tu cuenta de usuario. Por favor intenta nuevamente.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
            
            $url_confirmacion = base_url()."index.php/login";
            redirect($url_confirmacion);
            
        }
        
        
    }
    public function activar_nuevo_registro($id_usuario_pss, $token) {
        // se verifica si el usuario y el token aparecen en la tabla en turno
        $this->db->where("id_usuario_pss",$id_usuario_pss);
        $this->db->where("token",$token);
        $token_cuenta_nueva = Model\Pss_token_cuenta_nueva::all();
        
        // si existe
        if ( $token_cuenta_nueva != null ) {
            // si la cuenta de usuario esta pendiente se activa
            $usuario = Model\Pss_usuario::find($id_usuario_pss);
            
            $usuario->id_estatus = 1;
            $usuario->save();
            
            // se notifica la activacion. Ya puede hacer sesion
            $this->session->set_flashdata('titulo', "Activación exitosa");
            $this->session->set_flashdata('mensaje', "Tu cuenta de usuario ha sido activada. Ya puedes hacer inicio de sesión.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
            
            $url_confirmacion = base_url()."index.php/login";
            redirect($url_confirmacion);
        } else {
            // usuario y token no existe, se envia a login
        }
    }
}
