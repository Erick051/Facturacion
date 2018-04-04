<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

 function __construct() {
        parent::__construct();

        // si la sesion ya expiro, entonces se envia a la pagina de inicio para hacer login nuevamente
        $existe_sesion = $this->session->userdata("id_usuario");
        if ( empty( $existe_sesion ) ) {
            $this->session->set_flashdata("sesion_caduca","Su sesión ha caducado. Haga inicio de sesión nuevamente");
            redirect(site_url(),'refresh');
        }

    }

  /* controlador para gestionar las cuentas de usuario */
  public function index()
  {
  // clave del usuario
  $id_usuario = $this->session->userdata("id_usuario");

    $data = array();
    $data["id_usuario"] = $id_usuario;

    $url_alta_usuario = base_url()."index.php/usuarios/agregar_usuario/";
    $data["url_alta_usuario"] = $url_alta_usuario;

    // la url para ver los detalles del usuario
    $url_detalle_usuario = base_url()."index.php/usuarios/ver_detalle_usuario";
    $data["url_detalle_usuario"] = $url_detalle_usuario;

    // la url para ver los detalles del usuario
    $url_editar_usuario = base_url()."index.php/usuarios/editar_usuario";
    $data["url_editar_usuario"] = $url_editar_usuario;

    // la url para cambiar el estado del registro
    $url_cambiar_estado_usuario = base_url()."index.php/usuarios/cambiar_estado_usuario";
    $data["url_cambiar_estado_usuario"] = $url_cambiar_estado_usuario;

    // url para asociar usuarios con registros de clientes
    $url_relacion_cliente_usuario = base_url()."index.php/usuarios/relacion_cliente_usuario";
    $data["url_relacion_cliente_usuario"] = $url_relacion_cliente_usuario;

    // si se recibio el mensaje de confirmacion se agrega a los datos pasados a la vista
    if ( $this->session->flashdata('titulo') != null ) {
      $data["titulo"]       = $this->session->flashdata('titulo');
      $data["mensaje"]      = $this->session->flashdata('mensaje');
      $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
    }

    // se obtiene la lista de usuarios
    $arrusuarios = Model\Pss_usuario::all();
    $data["arrusuarios"] = $arrusuarios;

    // se arma la vista de listadao de usuarios
    cargar_interfaz_grafica($this, $data, "usuarios/view_content_wrapper_usuarios", "usuarios/view_content_wrapper_usuarios_script");
  }


  // ===============================================================================
  // Formulario para capturar los datos del usuario nuevo
  //
  // ====================================================
  public function agregar_usuario($mensaje_confirmacion = null) {

  $id_usuario = $this->session->userdata("id_usuario");

    // registra evento en bitacora
    //registrar_evento_bitacora($this, $id_usuario, ALTA_DE_USUARIO);

    $data = array();
    $data["id_usuario"]      = $id_usuario;

    // si se recibio el mensaje de confirmacion se agrega a los datos pasados a la vista
    if ( $this->session->flashdata('titulo') != null ) {
      $data["titulo"]       = $this->session->flashdata('titulo');
      $data["mensaje"]      = $this->session->flashdata('mensaje');
      $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
    }

    // la url anterio en caso de cancelar el alta
    $url_anterior = base_url()."index.php/usuarios/index/";
    $data["url_anterior"] = $url_anterior;

    // la url para agregar usuario
    $url_action_alta_usuario = base_url()."index.php/usuarios/f_agregar_usuario";
    $data["url_action_alta_usuario"] = $url_action_alta_usuario;

    //$arrperfiles = Model\Perfil::all();
    //$data["arrperfiles"] = $arrperfiles;

    $arrpreguntas = Model\c_preguntas_recuperacion::all();
    $data["arrpreguntas"] = $arrpreguntas;

    $this->db->WHERE("id_tipo_usuario > 1");
    $arrtipousuario = Model\pss_c_tipo_usuario::all();
    $data["arrtipousuario"] = $arrtipousuario;


    // pantalla de alta de usuario
    cargar_interfaz_grafica($this, $data, "usuarios/view_content_wrapper_usuarios_alta", null);
  }

  // ===============================================================================
  // Funcion que genera agrega el usuario
  //
  // ====================================================
  public function f_agregar_usuario() {
    // se obtiene usuario
  $id_usuario = $this->session->userdata("id_usuario");

    // datos del usuario
    $login                           = $this->input->post("login");
    $email                           = $this->input->post("email");
    $contrasena                      = $this->input->post("contrasena");
    $confirmar_contrasena            = $this->input->post("confirmar_contrasena");
    $nombre                          = $this->input->post("nombre");
    $apellido_paterno                = $this->input->post("apellido_paterno");
    $apellido_materno                = $this->input->post("apellido_materno");
    $id_pregunta_recuperacion        = $this->input->post("id_pregunta_recuperacion");
    $respuesta_recuperar_contrasena  = $this->input->post("respuesta_recuperar_contrasena");
    $id_tipo_usuario                 = $this->input->post("id_tipo_usuario");

    $data = array();


    // ---------------------- validacion de los datos --------------------------
    $this->load->library("form_validation");

    // se establecen las reglas de validacion
  $this->form_validation->set_rules("login","Login","required");
  $this->form_validation->set_rules("email","email","required");
  $this->form_validation->set_rules("contrasena","Contraseña","required");
  $this->form_validation->set_rules("confirmar_contrasena","Confirmar contraseña","required");
  $this->form_validation->set_rules("nombre","Nombre","required");
  $this->form_validation->set_rules("apellido_paterno","Apellido paterno","required");
  $this->form_validation->set_rules("id_pregunta_recuperacion","Pregunta para recuperar la contraseña","required");
  $this->form_validation->set_rules("respuesta_recuperar_contrasena","Respuesta para recuperar la contraseña","required");
  $this->form_validation->set_rules("id_tipo_usuario","Tipo de usuario","required");


    // se verifican los datos recibidos
    if ( $this->form_validation->run() == FALSE )
    {
      // error en los datos
      // se crea el mensaje de error
      $this->session->set_flashdata('titulo', "Error en los datos");
      $this->session->set_flashdata('mensaje', validation_errors());
      $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

      // se regresa al formulario de alta con los datos para que el usuario corrija
      $this->agregar_usuario();
    }
    else
    {

    // se valida la concidencia de la contrasena y su confirmacion
    if ( $contrasena != $confirmar_contrasena ) {
         // se crea el mensaje de error
         $this->session->set_flashdata('titulo', "Error en los datos");
         $this->session->set_flashdata('mensaje', 'La contraseña elegida y su confirmación no coinciden');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

         // se regresa al formulario de alta con los datos para que el usuario corrija
         $this->agregar_usuario();
    }

      // datos correctos, se procede a generar el registro nuevo
      // se carga el modelo de institucion para trabajar con la nueva asignatura
      $nuevo_usuario = new Model\Pss_usuario();

      // se asignan los datos


      $nuevo_usuario->id_usuario_pss                  = 0;
      $nuevo_usuario->login                           = $login;
      $nuevo_usuario->contrasena                      = MD5($contrasena);
      $nuevo_usuario->id_pregunta_recuperacion        = $id_pregunta_recuperacion;
      $nuevo_usuario->respuesta_recuperar_contrasena  = $respuesta_recuperar_contrasena;
      $nuevo_usuario->nombre                          = $nombre;
      $nuevo_usuario->apellido_paterno                = $apellido_paterno;
      $nuevo_usuario->apellido_materno                = $apellido_materno;
      $nuevo_usuario->email                           = $email;
      $nuevo_usuario->fecha_alta                      = date("Y-m-d");
      $nuevo_usuario->dir_ip                          = $this->input->ip_address();
      $nuevo_usuario->tipo_usuario                    = $id_tipo_usuario;

      // se guarda el registro
      $nuevo_usuario->save();

      $insercion_correcta = true;


      // si fue exitosa, se invoca el listado de asignaturas
      if ( $insercion_correcta ) {
          
          // 20180313 se agrega envio de correo al crear cuenta
          $remitente    = Model\Envio_correo_remitente::find_by_es_default(1, FALSE);
          $destinatario = new Model\Envio_correo_destinatario();
          $envio        = new Model\Envio_correo();
          $adjunto      = new Model\Envio_correo_adjuntos();
          
          // se obtiene la configuracion del portal
          $config_portal = Model\pss_config_portal::find(1);
          
          // se llenan los datos para el envio de correo
          $envio->id_envio_correo  = 0;
          $envio->id_transaccion   = null;
          $envio->id_proceso       = null;
          $envio->id_remitente     = $remitente->id_remitente;
          $envio->procesado        = -1; // pendiente
          $envio->fecha_registro   = date("Y-m-d");
          $envio->fecha_proceso    = null;
          $envio->enviar_adjuntos  = 0;
          $envio->asunto           = "Acceso para ".$config_portal->titulo_pantalla_principal;
          
          $cuerpo_correo = "ESTIMADO(A) ".$nombre.":<br><br>Se ha creado correctamente su cuenta de usuario, para acceder al portal de facturación electrónica.<br><br>Sus datos de acceso son:<br>Usuario: ".$login.                         "<br>Contraseña: ".$contrasena."<br><br><br>Sitio WEB: ".base_url()."<br><br><br><br>El usuario se responsabilizará del uso correcto de las claves de acceso concedidas, las cuales son intransferibles y pueden ser revocadas o canceladas ante un uso inadecuado.<br><br><br>Nota: No es necesario responder a esta cuenta de correo.";


          $envio->cuerpo = $cuerpo_correo;
          $envio->save();
          
          // se obtiene el id de envio
          $id_envio = Model\Envio_correo::last_created()->id_envio_correo;
          // se asigna al registro
          $envio = Model\Envio_correo::find($id_envio);
          
          // se genera el registro del destinatario
          $destinatario->id_correo_destinatario = 0;
          $destinatario->id_envio_correo        = $id_envio;
          $destinatario->destinatario           = $email;
          $destinatario->fecha_proceso          = null;
          $destinatario->estatus_envio          = 1;
          $destinatario->cod_error              = null;
          $destinatario->d_error                = null;
          $destinatario->num_intentos           = 0;
          $destinatario->save();
          
          // se actualiza el registro de envio para que el ejecutor de envio lo considere
          $envio->procesado = 1; // listo para enviar
          $envio->save();

          // se cambia el estatus del correo para que se pueda enviar
          $envio->procesado        = 0; // pendiente
          $envio->save();

         // se crea el mensaje de error
         $this->session->set_flashdata('titulo', "Nuevo usuario creado");
         $this->session->set_flashdata('mensaje', 'La cuenta de usuario ['.$login.'] ha sido creada correctamente y una notificación por correo electrónico será enviada al usuario en breve.');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');

        $url_principal = base_url()."index.php/usuarios/index/";
        redirect($url_principal);
        //$this->f_principal_asignatura($i_usuario, $nombre_usuario, $mensaje_confirmacion);
      }
      else {
        // se regresa al formulario de alta con el error
         $this->session->set_flashdata('titulo', "Error al crear la cuenta de usuario");
         $this->session->set_flashdata('mensaje', 'Ocurrió un error al tratar de generar la cuenta de usuario ['.$login.']. Por favor intente más tarde.');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

        $this->f_formulario_agregar_usuario($mensaje_confirmacion);
      }


    }
  }

  // ===============================================================================
  // Funcion que muestra los datos de usuario para editarlos
  //
  // ====================================================
  public function editar_usuario($id_usuario_elegido) {

    // se agrega la informacion al arreglo de datos para la vista
    $data = array();

    // registra evento en bitacora
    //registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), CAMBIO_DE_USUARIO);

    $usuario = Model\Pss_usuario::find($id_usuario_elegido);
    $data["usuario"] = $usuario;

    // URLs para tema y subtema de temario de asignatura
    $url_actualizar_datos_usuario  = base_url()."index.php/usuarios/f_actualizar_usuario";
    $data["url_actualizar_datos_usuario"] = $url_actualizar_datos_usuario;

    // url anterior por si cancela la vista de usuarios
    $url_anterior = base_url()."index.php/usuarios/index/";
    $data["url_anterior"] = $url_anterior;

    /*
    $arrperfiles = Model\Perfil::all();
    $data["arrperfiles"] = $arrperfiles;

    $arrestados = Model\C_estado_registro::all();
    $data["arrestados"] = $arrestados;
    */

    $arrpreguntas = Model\c_preguntas_recuperacion::all();
    $data["arrpreguntas"] = $arrpreguntas;

    if($usuario->tipo_usuario != 1){
    $this->db->WHERE("id_tipo_usuario > 1");
    }
    $arrtipousuario = Model\pss_c_tipo_usuario::all();
    $data["arrtipousuario"] = $arrtipousuario;

    // si hay mensaje de confirmacion
    // si se recibio el mensaje de confirmacion se agrega a los datos pasados a la vista
    if ( $this->session->flashdata('titulo') != null ) {
      $data["titulo"]       = $this->session->flashdata('titulo');
      $data["mensaje"]      = $this->session->flashdata('mensaje');
      $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
    }

    // se arma la vista de detalle de asignatura
    cargar_interfaz_grafica($this, $data, "usuarios/view_content_wrapper_usuarios_editar", "usuarios/view_content_wrapper_usuarios_script");
  }


  // ===============================================================================
  // Funcion que genera actualiza los datos del usuario
  //
  // ====================================================
  public function f_actualizar_usuario() {
    // datos del usuario
    $id_usuario_editado              = $this->input->post("id_usuario_editado");
    $login                           = $this->input->post("login");
    $email                           = $this->input->post("email");
    $contrasena                      = $this->input->post("contrasena");
    $confirmar_contrasena            = $this->input->post("confirmar_contrasena");
    $nombre                          = $this->input->post("nombre");
    $apellido_paterno                = $this->input->post("apellido_paterno");
    $apellido_materno                = $this->input->post("apellido_materno");
    $id_pregunta_recuperacion        = $this->input->post("id_pregunta_recuperacion");
    $respuesta_recuperar_contrasena  = $this->input->post("respuesta_recuperar_contrasena");
    $tipo_usuario                    = $this->input->post("id_tipo_usuario");

    $data = array();


    // ---------------------- validacion de los datos --------------------------
    $this->load->library("form_validation");

    // se establecen las reglas de validacion
  $this->form_validation->set_rules("login","Login","required");
  $this->form_validation->set_rules("nombre","Nombre","required");
  $this->form_validation->set_rules("apellido_paterno","Apellido paterno","required");
  $this->form_validation->set_rules("id_pregunta_recuperacion","Pregunta para recuperar la contraseña","required");
  $this->form_validation->set_rules("respuesta_recuperar_contrasena","Respuesta para recuperar la contraseña","required");

    // se verifican los datos recibidos
    if ( $this->form_validation->run() == FALSE )
    {
      // error en los datos
      $this->session->set_flashdata('titulo', "Error en los datos");
      $this->session->set_flashdata('mensaje', validation_errors());
      $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

      // se regresa al formulario de alta con los datos para que el usuario corrija
      $this->editar_usuario($id_usuario_editado);
    }
    else
    {

    // se valida la concidencia de la contrasena y su confirmacion
    if ( $contrasena != $confirmar_contrasena ) {
         // se crea el mensaje de error
         $this->session->set_flashdata('titulo', "Error en los datos");
         $this->session->set_flashdata('mensaje', 'La contraseña y su confirmación no coinciden.');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

         // se regresa al formulario de alta con los datos para que el usuario corrija
         $this->editar_usuario($id_usuario_editado);
    }

      // datos correctos, se procede a generar el registro nuevo
      // se carga el modelo de institucion para trabajar con la nueva asignatura
      $usuario = Model\Pss_usuario::find($id_usuario_editado);

      // se asignan los datos
      $usuario->login                           = $login;
      if ( $contrasena != '' || $contrasena != null ) {
          $usuario->contrasena                      = MD5($contrasena);
      }
      $usuario->contrasena                      = MD5($contrasena);
      $usuario->id_pregunta_recuperacion        = $id_pregunta_recuperacion;
      $usuario->respuesta_recuperar_contrasena  = $respuesta_recuperar_contrasena;
      $usuario->nombre                          = $nombre;
      $usuario->apellido_paterno                = $apellido_paterno;
      $usuario->apellido_materno                = $apellido_materno;
      $usuario->email                           = $email;
      $usuario->fecha_alta                      = date("Y-m-d");
      $usuario->dir_ip                          = $this->input->ip_address();
      $usuario->tipo_usuario                    = $tipo_usuario;
      // se guarda el registro
      $usuario->save();

      $insercion_correcta = true;

      // si fue exitosa, se invoca el listado de asignaturas
      if ( $insercion_correcta ) {
         $this->session->set_flashdata('titulo', "Edición de usuario");
         $this->session->set_flashdata('mensaje', 'Los datos de la cuenta de usuario ['.$login.'] han sido actualizados correctamente');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');

        $url_principal = base_url()."index.php/usuarios/index/";
        redirect($url_principal);
        //$this->f_principal_asignatura($i_usuario, $nombre_usuario, $mensaje_confirmacion);
      }
      else {
        // se regresa al formulario de alta con el error
         $this->session->set_flashdata('titulo', "Error en la actualización");
         $this->session->set_flashdata('mensaje', 'Ocurrió un error durante la actualización de los datos de la cuenta de usuario ['.$login.']. Por favor intente de nuevo más tarde.');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

        $this->editar_usuario($id_usuario_editado);
      }


    }
  }

  // ===============================================================================
  // Funcion que genera cambia el estatus del registro de usuario
  //
  // ====================================================
  public function cambiar_estado_usuario($id_usuario, $id_estado_registro) {
    $data = array();

    // datos correctos, se procede a generar el registro nuevo
    // se carga el modelo de institucion para trabajar con la nueva asignatura
    $usuario = Model\Jos_users::find($id_usuario);

    // se asignan los datos
    $usuario->id          = $id_usuario;
    $usuario->block       = $id_estado_registro;

    // si es desbloqueo, el numero de intentos se reinicia
    if ( $id_estado_registro == 0 ) {
        $usuario_seguridad = Model\Jos_user_security::find_by_username($usuario->username, false);

        if ( $usuario_seguridad != null ) {
            $usuario_seguridad->intentos = 0;
            $usuario_seguridad->save();
        }
    }


    // se guarda el registro
    $usuario->save();

    $insercion_correcta = true;

    // si fue exitosa, se invoca el listado de usuarios
    if ( $insercion_correcta ) {
         $this->session->set_flashdata('titulo', "Actualización de estatus de cuenta de usuario");

         if ( $id_estado_registro == 0 ) {
             // desbloqueado
             $this->session->set_flashdata('mensaje', 'La cuenta de usuario ['.$usuario->username.'] han sido desbloqueada correctamente.');

             // registra evento en bitacora
             registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), DESBLOQUEO_DE_USUARIO);

         } else {
             // bloqueado
             $this->session->set_flashdata('mensaje', 'La cuenta de usuario ['.$usuario->username.'] han sido bloqueada correctamente.');

             // registra evento en bitacora
             registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), BLOQUEO_DE_USUARIO);
         }


         $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
    }
    else {
      // se regresa al formulario de alta con el error
         $this->session->set_flashdata('titulo', "Error en la actualización");
         $this->session->set_flashdata('mensaje', 'Ocurrió un error durante la actualización de los datos de la cuenta de usuario ['.$usuario->username.']. Por favor intente de nuevo más tarde.');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
    }

    $url_principal = base_url()."index.php/usuarios/index/";
    redirect($url_principal);

  }

  // ===============================================================================
  // Funcion que muestra los detalles de la cuenta de un usuario
  //
  // ====================================================
  public function ver_detalle_usuario($id_usuario_elegido) {

    // se agrega la informacion al arreglo de datos para la vista
    $data = array();

    // registra evento en bitacora
    //registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), CAMBIO_DE_USUARIO);

    $usuario = Model\Pss_usuario::find($id_usuario_elegido);
    $data["usuario"] = $usuario;

    // URLs para tema y subtema de temario de asignatura
    $url_elegir_cliente  = base_url()."index.php/usuarios/elegir_cliente/".$id_usuario_elegido;
    $data["url_elegir_cliente"] = $url_elegir_cliente;

    // url para eliminar la relacion entre cliente y cuenta de usuario
    $url_eliminar_relacion_cliente_usuario  = base_url()."index.php/usuarios/eliminar_relacion_cliente_usuario/".$id_usuario_elegido;
    $data["url_eliminar_relacion_cliente_usuario"] = $url_eliminar_relacion_cliente_usuario;

    // url anterior por si cancela la vista de usuarios
    $url_anterior = base_url()."index.php/usuarios/index/";
    $data["url_anterior"] = $url_anterior;

    /*
    $arrperfiles = Model\Perfil::all();
    $data["arrperfiles"] = $arrperfiles;

    $arrestados = Model\C_estado_registro::all();
    $data["arrestados"] = $arrestados;
    */

    $arrpreguntas = Model\c_preguntas_recuperacion::all();
    $data["arrpreguntas"] = $arrpreguntas;

    // se obtiene la relacion de clientes asociados al usuario
    $arr_r_usuario_cliente = Model\Pss_r_usuario_cliente::find_by_id_usuario($id_usuario_elegido);

    // se obtienen los datos fiscales del usuario
    $arr_clientes = array();
    $i = 1;
    foreach ($arr_r_usuario_cliente as $usuario_cliente) {
        $cliente = Model\C_clientes::find($usuario_cliente->id_cliente, false);

        if ($cliente != null ) {
            // se agrega el cliente al arreglo de clientes
            $arr_clientes[$i] = $cliente;
            $i++;
        }
    }
    $data["arr_clientes"] = $arr_clientes;

    // si hay mensaje de confirmacion
    // si se recibio el mensaje de confirmacion se agrega a los datos pasados a la vista
    if ( $this->session->flashdata('titulo') != null ) {
      $data["titulo"]       = $this->session->flashdata('titulo');
      $data["mensaje"]      = $this->session->flashdata('mensaje');
      $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
    }

    // se arma la vista de detalle de asignatura
    cargar_interfaz_grafica($this, $data, "usuarios/view_content_wrapper_usuarios_detalle", null);
  }

  // ===============================================================================
  // Funcion que muestra la lista de clientes disponibles para relacionar con el usuario elegido
  //
  // ====================================================
  public function elegir_cliente($id_usuario_elegido) {

    // se agrega la informacion al arreglo de datos para la vista
    $data = array();

    // registra evento en bitacora
    //registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), CAMBIO_DE_USUARIO);

    $usuario = Model\Pss_usuario::find($id_usuario_elegido);
    $data["usuario"] = $usuario;

    // URLs para tema y subtema de temario de asignatura
    $url_agregar_relacion_cliente_usuario  = base_url()."index.php/usuarios/agregar_relacion_cliente_usuario/".$id_usuario_elegido;
    $data["url_agregar_relacion_cliente_usuario"] = $url_agregar_relacion_cliente_usuario;

    // url anterior por si cancela la vista de usuarios
    $url_anterior = base_url()."index.php/usuarios/ver_detalle_usuario/".$id_usuario_elegido;
    $data["url_anterior"] = $url_anterior;

    // se obtienen los clientes que tiene asignados el usuario
    $arr_r_usuario_cliente = Model\Pss_r_usuario_cliente::find_by_id_usuario($id_usuario_elegido);

    $arr_clientes = array();
    // si hay registros
    if ( count($arr_clientes) > 0 ) {
        $i = 1;
        $where_rfcs = "id_cliente not in (";
        foreach ($arr_r_usuario_cliente as $usuario_cliente) {
            $cliente = Model\C_clientes::find($usuario_cliente->id_cliente);

            // se agrega el cliente al arreglo de clientes
            $arr_clientes[$i] = $cliente;

            // el primer rfc no lleva coma
            if ( $i == 1 ) {
                $where_rfcs .= "'".$cliente->id_cliente."'";
            } else {
                $where_rfcs .= ",'".$cliente->id_cliente."'";
            }

            $i++;

        }
        $data["arr_clientes"] = $arr_clientes;

        // se cierra el where rfcs
        $where_rfcs .= ")";

        $this->db->where($where_rfcs);
    }

    $arr_clientes_disponibles = Model\C_clientes::all();
    $data["arr_clientes_disponibles"] = $arr_clientes_disponibles;

    // si hay mensaje de confirmacion
    // si se recibio el mensaje de confirmacion se agrega a los datos pasados a la vista
    if ( $this->session->flashdata('titulo') != null ) {
      $data["titulo"]       = $this->session->flashdata('titulo');
      $data["mensaje"]      = $this->session->flashdata('mensaje');
      $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
    }

    // se arma la vista de detalle de asignatura
    cargar_interfaz_grafica($this, $data, "usuarios/view_content_wrapper_usuarios_elegir_cliente", null);
  }

  // ===============================================================================
  // Funcion para eliminar la relacion entre cliente y usuario
  //
  // ====================================================
  public function eliminar_relacion_cliente_usuario($id_usuario_elegido, $id_cliente) {

    // se prepara la eliminacion
    $this->db->where("id_usuario",$id_usuario_elegido);
    $this->db->where("id_cliente",$id_cliente);
    $this->db->delete('pss_r_usuario_cliente');

    // se crea el mensaje de eliminacion
    $this->session->set_flashdata('titulo', "Relacion usuario-cliente eliminada");
    $this->session->set_flashdata('mensaje', 'La relación entre la cuenta de usuario y la razón social elegidas ha sido eliminada correctamente.');
    $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');

    $url_principal = base_url()."index.php/usuarios/ver_detalle_usuario/".$id_usuario_elegido;
    redirect($url_principal);

  }

  // ===============================================================================
  // Funcion para agregar la relacion entre cliente y usuario
  //
  // ====================================================
  public function agregar_relacion_cliente_usuario($id_usuario_elegido, $id_cliente) {

    // se prepara la relacion
    $nueva_relacion = new Model\Pss_r_usuario_cliente();
    $nueva_relacion->id_usuario = $id_usuario_elegido;
    $nueva_relacion->id_cliente = $id_cliente;
    $nueva_relacion->fecha_alta = date("Ymd");
    $nueva_relacion->save();

    // se envia mensaje a pantalla indicando la relacion exitosa
    $this->session->set_flashdata('titulo', "Relación de razón social con cuenta de usuario");
    $this->session->set_flashdata('mensaje', "La relación entre la razón social elegida y la cuenta de usuario dada ha sido creada correctamente");
    $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');

    $url_principal = base_url()."index.php/usuarios/ver_detalle_usuario/".$id_usuario_elegido;
    redirect($url_principal);

  }

  // ===============================================================================
  // Funcion que muestra habilita un formulario para que un usuario cambie su contrasena
  //
  // ====================================================
  public function cambiar_contrasena_usuario() {
    $data = array();

    // url anterior
    $url_anterior = base_url()."index.php/".URL_PANTALLA_PRINCIPAL;
    $data["url_anterior"] = $url_anterior;

    // url del formulario para cambiar la contrasena
    $url_cambio_contrasena = base_url()."index.php/usuarios/f_cambiar_contrasena";
    $data["url_cambio_contrasena"] = $url_cambio_contrasena;

    // si se recibio el mensaje de confirmacion se agrega a los datos pasados a la vista
    if ( $this->session->flashdata('titulo') != null ) {
      $data["titulo"]       = $this->session->flashdata('titulo');
      $data["mensaje"]      = $this->session->flashdata('mensaje');
      $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
    }

    // registra evento en bitacora
    //registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), CAMBIO_DE_CONTRASENA_DE_USUARIO);

    // se arma la vista de listadao de usuarios
    cargar_interfaz_grafica($this, $data, "usuarios/view_content_wrapper_usuarios_cambiar_mi_contrasena", null);

  }

  // ===============================================================================
  // Funcion que genera cambia la contrasena de un usuario firmado
  //
  // ====================================================
  public function f_cambiar_contrasena() {

    // datos del usuario
    $id_usuario                   = $this->session->userdata("id_usuario"); // el usuario firmado
    $contrasena_actual            = $this->input->post("contrasena_actual");
    $contrasena                   = $this->input->post("contrasena");
    $confirmar_contrasena         = $this->input->post("confirmar_contrasena");

    // ---------------------- validacion de los datos --------------------------
    // se establecen las reglas de validacion
    $this->form_validation->set_rules("contrasena_actual","contrasena_actual","required");
  $this->form_validation->set_rules("contrasena","Contraseña","required");
  $this->form_validation->set_rules("confirmar_contrasena","Confirmar contraseña","required");

    // se verifican los datos recibidos
    if ( $this->form_validation->run() == FALSE )
    {
      // error en los datos
      $this->session->set_flashdata('titulo', "Error en los datos");
      $this->session->set_flashdata('mensaje', validation_errors());
      $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

      // se regresa al formulario de alta con los datos para que el usuario corrija
      $this->cambiar_contrasena_usuario();
    }
    else
    {
      // se carga el modelo de institucion para trabajar con la nueva asignatura
      $usuario = Model\Pss_usuario::find($id_usuario);

      // si la contrasena actual no es valida
      if ( $usuario->contrasena != MD5($contrasena_actual) ) {

         $this->session->set_flashdata('titulo', "Error en los datos");
         $this->session->set_flashdata('mensaje', 'La contraseña actual capturada no es correcta.');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

         // registra evento en bitacora
         //registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), CAMBIO_DE_CONTRASENA_DE_USUARIO_ERROR);

         // se regresa al formulario de alta con los datos para que el usuario corrija
         $url_principal = base_url()."index.php/usuarios/cambiar_contrasena_usuario";
         redirect($url_principal);
      }

    // se valida la concidencia de la contrasena y su confirmacion
    if ( $contrasena != $confirmar_contrasena ) {
         // se crea el mensaje de error
         $this->session->set_flashdata('titulo', "Error en los datos");
         $this->session->set_flashdata('mensaje', 'La contraseña y su confirmación no coinciden.');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

         // se regresa al formulario de alta con los datos para que el usuario corrija
         $url_principal = base_url()."index.php/usuarios/cambiar_contrasena_usuario";
         redirect($url_principal);

    }

      // se actualiza la contrasena del usuario
      //$usuario->id_usuario  = $id_usuario;
      $usuario->contrasena  = MD5($contrasena);
      // se guarda el registro
      $usuario->save();

      $insercion_correcta = true;

      // si fue exitosa, se envia al usuario a la pantalla principal
      if ( $insercion_correcta ) {

         // registra evento en bitacora
         //registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), CAMBIO_DE_CONTRASENA_DE_USUARIO_EXITOSO);

         $this->session->set_flashdata('titulo', "Cambio de contraseña");
         $this->session->set_flashdata('mensaje', 'La contraseña ha sido cambiada correctamente.');
         $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
         $url_principal = base_url()."index.php/".URL_PANTALLA_PRINCIPAL;
         redirect($url_principal);

      }
      else {
        // se regresa al formulario de cambio de contrasena
           $this->session->set_flashdata('titulo', "Error en la actualización");
           $this->session->set_flashdata('mensaje', 'Ocurrió un error durante la actualización de los datos de la cuenta de usuario ['.$login.']. Por favor intente de nuevo más tarde.');
           $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
           $this->cambiar_contrasena_usuario();
      }
    }
  }



}
