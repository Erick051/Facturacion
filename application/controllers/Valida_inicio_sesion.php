<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Valida_inicio_sesion extends CI_Controller {

	/**
	 * Inicio de sesion
	 *
	 */
 
	public function index()
	{   
      // se obtienen los datos de login y contrasena y la altura interna de la pagina
      $login               = $this->input->post("login");
      $contrasena          = MD5($this->input->post("contrasena"));
      
      // se carga la config del portal para verificar como se validaran las credenciales
      $config_portal = Model\Pss_config_portal::find(1, false);
      
      // se verifica si existe un usuario registrado con el login dado
      if ($config_portal->usar_contrasena == "2" && strtoupper($login) != "ADMINISTRADOR") {
        // idntificacion por email y cuando no se trate del administrador
        $pss_usuario = Model\Pss_usuario::find_by_email($login, false);  
      }else{
        // buscqueda por login
        $pss_usuario = Model\Pss_usuario::find_by_login($login, false);
        //die($this->input->post("contrasena").' - '.$login.' - '.$contrasena.' - '.$pss_usuario->contrasena);
      }
      
      
      if ($config_portal->usar_contrasena == "3" && strtoupper($login) != "ADMINISTRADOR" && $pss_usuario->tipo_usuario == 4) {
        $contrasena = $pss_usuario->contrasena;
      }

      // si se encontro al usuario

      if ( $pss_usuario != null ) { 
          // si no se valida contrasena y/o se esta identificando al usuario mediante RFC
          if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN || $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
            // si no se trata de un usuario SIN privilegios
              if ( $pss_usuario->tipo_usuario > 3 ) {                
     	            // se crea la sesion del usuario
    	            $this->session->set_userdata("id_usuario", $pss_usuario->id_usuario_pss);
    	            $this->session->set_userdata("nombre_usuario", $pss_usuario->nombre);
                  $this->session->set_userdata("fecha_alta_usuario", $pss_usuario->fecha_alta);
                  $this->session->set_userdata("titulo_menu", $config_portal->titulo_menu);
                  $this->session->set_userdata("titulo_pantalla_principal", $config_portal->titulo_pantalla_principal);
                  // se verifica si el login es a traves de RFC
                  if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
                      // se verifica si el login es un RFC generico
                      if ( $login == "XAXX010101000" || $login == "XEXX010101000" ) {
                          // se agregan mensaje indicando que el usuario esta usando un rfc generico y que debera verificar si sus datos ya estan registrados
                          if ( $login == "XAXX010101000" ) {
                              $titulo = "Inicio de sesión con RFC Genérico mexicano XAXX010101000";
                          } else {
                              $titulo = "Inicio de sesión con RFC Genérico extranjero XEXX010101000";
                          }
                          $this->session->set_flashdata('titulo', $titulo);
                          $mensaje  = "<h2>Estimado cliente:</h2>";
                          $mensaje .= "<br><h3>Está ingresando con un RFC Genérico que puede ser usado por más de una persona o entidad. Al ingresar al área <strong>Facturar ticket</strong> será necesario que verifique sus datos. En caso de no encontrarlos, podrá registrar su nombre y domicilio específico en la sección <strong>Mi Perfil</strong>.</h3>";
                          $this->session->set_flashdata('mensaje', $mensaje);
                          $this->session->set_flashdata('tipo_mensaje', 'alert alert-primary alert-dismissible');
                      }
                  }
                  
                  // se redirige a la pantalla principal
                  redirect(URL_PANTALLA_PRINCIPAL, 'refresh');
              } else {
                  // se trata de un usuario con privilegios, se le pide contrasena
                  $data = array();
                  $data["config_portal"] = $config_portal;
                  $data["login"] = $login;
                  $data["url_anterior"] = base_url();;
                  $data["url_valida_inicio_sesion_contrasena"] = base_url()."index.php/valida_inicio_sesion/valida_inicio_sesion_contrasena";
                  cargar_interfaz_grafica_login($this, $data, "view_login_contrasena", null);
                  
              }
          }
          else
          { 
            // se valida el usuario y la contrasena
            if ( $contrasena != $pss_usuario->contrasena ) {
                // se carga la pagina inicial que tiene los campos para iniciar sesion
                $this->session->set_flashdata('titulo', "Error al iniciar sesión");
                $this->session->set_flashdata('mensaje', "Por favor verifique su nombre de usuario y contraseña");
                $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
		        $url_login = base_url()."index.php/login/index";
                redirect($url_login);
            }
   	        // si el usuario se valido correctamente,  se crea la sesion del usuario
	        $this->session->set_userdata("id_usuario", $pss_usuario->id_usuario_pss);
	        $this->session->set_userdata("nombre_usuario", $pss_usuario->nombre);
            $this->session->set_userdata("fecha_alta_usuario", $pss_usuario->fecha_alta);
            $this->session->set_userdata("titulo_menu", $config_portal->titulo_menu);
            $this->session->set_userdata("titulo_pantalla_principal", $config_portal->titulo_pantalla_principal);

            // se redirige a la pantalla principal
            redirect(URL_PANTALLA_PRINCIPAL, 'refresh');
          }
          
      } 
      else {
          // si el portal esta configurado para usar RFC como login
          if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
              // se valida el RFC
              if ( $this->validarRFC($login) ) {
                  // se redirige a la ventana de registro de cuenta nueva
                  $this->session->set_flashdata('titulo', "Registrar cliente nuevo");
                  $this->session->set_flashdata('mensaje', "Sus datos no han sido encontrados en el sistema de facturación. Por favor capture sus datos fiscales.");
                  $this->session->set_flashdata('tipo_mensaje', 'alert bg-orange-active alert-dismissible');
                  
                  // se envia el RFC tecleado para prepoblar el campo
		          $url_login = base_url()."index.php/login/crear_cuenta_nueva/".$login;
                  redirect($url_login);
              } else {
                  // RFC es invalido
                  // se carga la pagina inicial que tiene los campos para iniciar sesion
                  $this->session->set_flashdata('titulo', "Error al identificar el RFC");
                  $this->session->set_flashdata('mensaje', "El RFC tecleado no cumple con la estructura definida");
                  $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
                  
		          $url_login = base_url()."index.php/login/index";
                  redirect($url_login);
              }


          } else {
              // se carga la pagina inicial que tiene los campos para iniciar sesion
              $this->session->set_flashdata('titulo', "Error al iniciar sesión");
              $this->session->set_flashdata('mensaje', "Por favor verifique su nombre de usuario");
              $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
              
		      $url_login = base_url()."index.php/login/index";
              redirect($url_login);
              
          }
      }
      
    
	}
    
    public function valida_inicio_sesion_contrasena() {
        // se obtienen los datos de login y contrasena y la altura interna de la pagina
        $login               = $this->input->post("login");
        $contrasena          = MD5($this->input->post("contrasena"));
      
        // se carga la config del portal para verificar como se validaran las credenciales
        $config_portal = Model\Pss_config_portal::find(1, false);
        
        // se verifica si existe un usuario registrado con el login dado
        if ($config_portal->usar_contrasena == "2" && strtoupper($login) != "ADMINISTRADOR") {
          // idntificacion por email y cuando no se trate del administrador
          $pss_usuario = Model\Pss_usuario::find_by_email($login, false);  
        }else{
          // buscqueda por login
          $pss_usuario = Model\Pss_usuario::find_by_login($login, false);
        }
      
        // se valida el usuario y la contrasena
        if ( $contrasena != $pss_usuario->contrasena ) {
            // se carga la pagina inicial que tiene los campos para iniciar sesion
            $this->session->set_flashdata('titulo', "Error al iniciar sesión");
            $this->session->set_flashdata('mensaje', "Por favor verifique su nombre de usuario y contraseña");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
		    $url_login = base_url()."index.php/login/index";
            redirect($url_login);
        }
   	    // si el usuario se valido correctamente,  se crea la sesion del usuario
	    $this->session->set_userdata("id_usuario", $pss_usuario->id_usuario_pss);
	    $this->session->set_userdata("nombre_usuario", $pss_usuario->nombre);
        $this->session->set_userdata("fecha_alta_usuario", $pss_usuario->fecha_alta);
        $this->session->set_userdata("titulo_menu", $config_portal->titulo_menu);
        $this->session->set_userdata("titulo_pantalla_principal", $config_portal->titulo_pantalla_principal);

        // se redirige a la pantalla principal
        redirect(URL_PANTALLA_PRINCIPAL, 'refresh');
    }
    
    public function valida_inicio_sesion_login_rfc($id_usuario = null) {
        // se carga la config del portal para verificar como se validaran las credenciales
        $config_portal = Model\Pss_config_portal::find(1, false);
        
        // se verifica si el portal esta configurado para usar el RFC como login
        if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC && $id_usuario != null ) {
            // idntificacion por email y cuando no se trate del administrador
            // si el id esta vacio
            $pss_usuario = Model\Pss_usuario::find($id_usuario, false);
          
   	        // si el usuario se valido correctamente,  se crea la sesion del usuario
	        $this->session->set_userdata("id_usuario", $pss_usuario->id_usuario_pss);
	        $this->session->set_userdata("nombre_usuario", $pss_usuario->nombre);
            $this->session->set_userdata("fecha_alta_usuario", $pss_usuario->fecha_alta);
            $this->session->set_userdata("titulo_menu", $config_portal->titulo_menu);
            $this->session->set_userdata("titulo_pantalla_principal", $config_portal->titulo_pantalla_principal);
            
            // se redirige a la pantalla principal
            redirect(URL_PANTALLA_PRINCIPAL, 'refresh');
        }else{
            // esta forma de acceso no esta disponible si no esta configurado el portal asi
		    $url_login = base_url()."index.php/login/index";
            redirect($url_login);
        }
    }
    
    function validarRFC($valor) {
    	 $valor = str_replace("-", "", $valor); 
        $cuartoValor = substr($valor, 3, 1);
        //RFC sin homoclave
        if(strlen($valor)==10){
            $letras = substr($valor, 0, 4); 
            $numeros = substr($valor, 4, 6);
            if (ctype_alpha($letras) && ctype_digit($numeros)) { 
                return true;
            }
            return false;            
        }
        // Sólo la homoclave
        else if (strlen($valor) == 3) {
            $homoclave = $valor;
            if(ctype_alnum($homoclave)){
                return true;
            }
            return false;
        }
        //RFC Persona Moral.
        else if (ctype_digit($cuartoValor) && strlen($valor) == 12) { 
            $letras = substr($valor, 0, 3); 
            $numeros = substr($valor, 3, 6); 
            $homoclave = substr($valor, 9, 3); 
            if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) { 
                return true; 
            } 
            return false;
        //RFC Persona Física. 
        } else if (ctype_alpha($cuartoValor) && strlen($valor) == 13) { 
            $letras = substr($valor, 0, 4); 
            $numeros = substr($valor, 4, 6);
            $homoclave = substr($valor, 10, 3); 
            if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) { 
                return true; 
            }
            return false; 
        }else { 
            return false; 
        }  
    }//fin función
}
