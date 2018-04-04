<?php

// modelo para controlar la ejecucion de los procesos

class model_control_procesos extends CI_model {

  // obtiene la lista de procesos registrados
  public function f_obtener_lista_procesos($tipo_acceso = 1)
  {
    // si el tipo de acceso es el normal
    if ( $tipo_acceso == 1 ) {
        // acceso normal
        $listado_procesos = Model\Proceso::all();
    } else {
        // acceso alterno
        $listado_procesos = Model\Proceso::all();
    }
  
    // se devuelve el arreglo con la lista de usuarios
    return $listado_procesos;
  }

  // registrar un proceso nuevo
  public function f_registrar_proceso($unProceso)
  {
    $nuevoProceso = new Model\Proceso();
    
  }

  public function f_registrar_nueva_ejecucion_proceso($id_proceso)
  {
    // se obtiene el id de ejecucion
    $secuenciaEjecucion = new Model\Seq_ejecucion();
    $secuenciaEjecucion->id_ejecucion = 0;
    $secuenciaEjecucion->save();
    
    $id_ejecucion = Model\Seq_ejecucion::last_created()->id_ejecucion;
    
    // se crea la instancia de control de proceso
    $nuevaEjecucion = new Model\Control_proceso();

    // se registran los datos
    $nuevaEjecucion->id_ejecucion        = $id_ejecucion;
    $nuevaEjecucion->id_proceso          = $id_proceso;
    $nuevaEjecucion->fecha_hora_inicio   = date("Y-m-d h:m:s");
    $nuevaEjecucion->fecha_hora_fin      = null;
    $nuevaEjecucion->id_usuario_inicio   = 0;
    $nuevaEjecucion->id_usuario_fin      = null;
    $nuevaEjecucion->id_estatus_proceso  = 1;
    $nuevaEjecucion->porcentaje_progreso = 0;
    
    // se guarda la ejecucion
    $nuevaEjecucion->save();
    
    // se crean las etapas del proceso
    $this->f_registrar_nueva_ejecucion_etapa_proceso($id_ejecucion, $id_proceso);
    
    // se devuelve el id de ejecucion
    return $id_ejecucion;
    
  }

  public function f_registrar_nueva_ejecucion_etapa_proceso($id_ejecucion, $id_proceso)
  {
    // se obtienen todas las etapas del proceso
    $etapasProceso = Model\Etapa_proceso::find_by_id_proceso($id_proceso);
    
    foreach ($etapasProceso as $etapa) {
        // se insertan como control de etapa de proceso en estatus pendiente
        $nuevoControlEtapaProceso = new Model\Control_etapa_proceso();
        
        $nuevoControlEtapaProceso->id_control_etapa_proceso = 0;
        $nuevoControlEtapaProceso->id_ejecucion             = $id_ejecucion;
        $nuevoControlEtapaProceso->id_proceso               = $id_proceso;
        $nuevoControlEtapaProceso->id_etapa                 = $etapa->id_etapa;
        $nuevoControlEtapaProceso->id_lote_proceso          = 0;
        $nuevoControlEtapaProceso->fecha_inicio             = null;
        $nuevoControlEtapaProceso->fecha_fin                = null;
        $nuevoControlEtapaProceso->id_estatus_etapa         = 1;
        $nuevoControlEtapaProceso->porcentaje_progreso      = 0;
        $nuevoControlEtapaProceso->id_usuario_registra      = 0;
        $nuevoControlEtapaProceso->id_usuario_ejecucion     = 0;
        $nuevoControlEtapaProceso->archivo_log              = null;
        
        // se guarda la etapa
        $nuevoControlEtapaProceso->save();
    }
    
  }

  
  public function f_registrar_fin_proceso($id_ejecucion, $proceso_terminado_correctamente = true)
  {
    // se crea la instancia de control de proceso
    $procesoActual = Model\Control_proceso::find($id_ejecucion);
    
    // se registran los datos
    $procesoActual->fecha_hora_fin      = date("Y-m-d h:m:s");
    $procesoActual->id_usuario_inicio   = 0;
    $procesoActual->id_usuario_fin      = 15;
    $procesoActual->id_estatus_proceso  = 5;
    $procesoActual->porcentaje_progreso = 100;
    
    // se guarda la ejecucion
    $procesoActual->save();
    
  }
  
  public function f_obtener_perfil_usuario($i_usuario)
  {
    // se obtiene el perfil del usuario
    $ls_sql =          " SELECT   i_perfil";
    $ls_sql = $ls_sql. " FROM     s_usuario_perfil";
    $ls_sql = $ls_sql. " WHERE    i_usuario = ".$i_usuario;

    //echo "<br><br><br><br><br><br><br><br>".$ls_sql;
    
    // se ejcuta la consulta del usuario
    $result_usuario = $this->db->query($ls_sql);
    
    // se obtiene el registro
    $i_perfil = $result_usuario->row()->i_perfil;

    // se libera el cursor
    $result_usuario->free_result();
  
    // se devuelve el perfil del usuario
    return $i_perfil;
  }

  
  // registro de cuenta de usuario en el sistema
  // 20160504 la contrasena va codificada con la funcion PASSWORD de MySQL
  public function f_registra_usuario($login, $contrasena, $pista_recupera_contrasena, $palabra_recupera_contrasena,
                                     $nombre, $apellido_paterno, $apellido_materno, $email,
                                     $email_secundario, $genero, $tipo_cuenta, $i_estado_registro, $img_avatar, $i_usuario_alta, $b_cuenta_caduca, $f_caducidad) {
/*
  i_usuario                   INTEGER, -- llave
  i_cuenta                    INTEGER, -- relacion a cuenta personal
  login                       CHAR(20), -- clave de usuario alfanumerica
  contrasena                  CHAR(20), -- contrasena
  pista_recupera_contrasena   CHAR(200), -- pregunta para recuperar contrasena
  palabra_recupera_contrasena CHAR(30), -- respuesta recuperar contrasena
  i_estado_registro           SMALLINT, -- estado de la cuenta: activa, inactiva, bloqueada
  i_usuario_alta              INTEGER, -- usuario que genero la cuenta de usuario
  b_cuenta_caduca             SMALLINT, -- booleana que indica si la cuenta caduca. 1- si caduca, 0-no caduca
  f_caducidad                 DATE, -- fecha de caducidad de la cuenta
  f_alta                      DATE, -- fecha en que se creo la cuenta
  h_alta                      TIME,
*/
    // se genera el i_usuario nuevo
    $i_usuario_nuevo = array("i_usuario" => 0);
    $this->db->insert("seq_usuario", $i_usuario_nuevo);
    
    // se obtiene el ultimo i_usuario
    $this->db->select("LAST_INSERT_ID() as i_usuario");
    $query = $this->db->get(null);
    $registro = $query->row();

    // se asume que la insercion sera correcta
    $lb_insercion_correcta = true;
    
  
    // se prepara el arreglo para generar la insercion
    // el id de usuaio se usa como id de cuenta
    $nuevo_usuario = array("i_usuario"                   => $registro->i_usuario         ,
                           "i_cuenta"                    => $registro->i_usuario         ,
                           "login"                       => $login                       ,
                           "pista_recupera_contrasena"   => $pista_recupera_contrasena   ,
                           "palabra_recupera_contrasena" => $palabra_recupera_contrasena ,
                           "i_estado_registro"           => $i_estado_registro           ,
						   "b_cuenta_caduca"             => $b_cuenta_caduca             ,
						   "f_caducidad"                 => $f_caducidad                 ,
                           "f_alta"                      => date("Ymd")                  ,
                           "h_alta"                      => date("H:i:s")                ,
                           "i_usuario_alta"              => $i_usuario_alta              );
						   
    // codificacion de la contrasena
	$lacontrasena = "PASSWORD('".$contrasena."')";
    $this->db->set('contrasena', $lacontrasena, FALSE);    
    
    // se inserta el usuario en base de datos
    $lb_insercion_correcta = $this->db->insert("s_usuario", $nuevo_usuario);
    
    // si el primer registro se pudo insertar
    if ( $lb_insercion_correcta ) 
    {
      // se inserta en la tabla cuenta_persona, se crea como cuenta activa
      $nueva_cuenta = array("i_cuenta"           => $registro->i_usuario ,
                            "nombre"             => $nombre              ,
                            "apellido_paterno"   => $apellido_paterno    ,
                            "apellido_materno"   => $apellido_materno    ,
                            "email"              => $email               ,
                            "email_secundario"   => $email_secundario    ,
                            "img_avatar"         => $img_avatar          ,
                            "genero"             => $genero              ,
                            "tipo_cuenta"        => $tipo_cuenta          ,
                            "i_estado_registro"  => 1                    ,
                            "f_alta"             => date("Ymd")          ,
                            "h_alta"             => date("H:i:s")        ,
                            "i_usuario"          => $i_usuario_alta      );
      
      // se inserta el usuario en base de datos
      $lb_insercion_correcta = $this->db->insert("cuenta_persona", $nueva_cuenta);
    }

    // el usuario se inserta sin privilegios
    if ( $lb_insercion_correcta ) 
    {
      // usuario con privilegio estudiante
      $nueva_cuenta = array("i_usuario"          => $registro->i_usuario ,
	                        "i_perfil"           => 200                  ,
                            "f_alta"             => date("Ymd")          ,
                            "h_alta"             => date("H:i:s")        ,
                            "i_usuario_registro" => $i_usuario_alta      );
      
      // se inserta el privilegio del usuario
      $lb_insercion_correcta = $this->db->insert("s_usuario_perfil", $nueva_cuenta);
    }

    
    // si la insercion tuvo errores
    if ( !$lb_insercion_correcta )
    {
      $arr_resultado_operacion["resultado_operacion"] = $lb_insercion_correcta;
      $arr_resultado_operacion["mensaje"]             = "Error al crear la cuenta de usuario: <br>";
      $arr_resultado_operacion["mensaje"]            .= "Error num: ".$this->db->_error_number()."<br>";
      $arr_resultado_operacion["mensaje"]            .= "Error msg: ".$this->db->_error_message();
    }
    else
    {
      // resultado correcto
      $arr_resultado_operacion["resultado_operacion"] = $lb_insercion_correcta;
      $arr_resultado_operacion["mensaje"]             = "Cuenta de usuario creada correctamente";
    }
    
	
    // se devuelve la booleana que indica si se pudo insertar el nuevo registro
    return $arr_resultado_operacion;
  }

  // registro de cuenta de usuario en el sistema  
  public function f_actualiza_usuario($i_usuario, $login, $contrasena, $pista_recupera_contrasena, $palabra_recupera_contrasena,
                                      $nombre, $apellido_paterno, $apellido_materno, $email,
                                      $email_secundario, $genero, $tipo_cuenta, $i_estado_registro, $img_avatar, $i_usuario_actualiza, $b_cuenta_caduca, $f_caducidad)
  {
  
/*
  i_usuario                   INTEGER, -- llave
  i_cuenta                    INTEGER, -- relacion a cuenta personal
  login                       CHAR(20), -- clave de usuario alfanumerica
  contrasena                  CHAR(20), -- contrasena
  pista_recupera_contrasena   CHAR(200), -- pregunta para recuperar contrasena
  palabra_recupera_contrasena CHAR(30), -- respuesta recuperar contrasena
  i_estado_registro               SMALLINT, -- estado de la cuenta: activa, inactiva, bloqueada
  i_usuario_alta              INTEGER, -- usuario que genero la cuenta de usuario
  f_alta                      DATE, -- fecha en que se creo la cuenta
  h_alta                      TIME,
*/
  
    // se prepara el arreglo para actualizar al usuario
    $usuario_actualizado = array("pista_recupera_contrasena"   => $pista_recupera_contrasena   ,
                                 "palabra_recupera_contrasena" => $palabra_recupera_contrasena ,
                                 "i_estado_registro"           => $i_estado_registro           ,
								 "b_cuenta_caduca"             => $b_cuenta_caduca             ,
								 "f_caducidad"                 => $f_caducidad                 ,
                                 "f_alta"                      => date("Ymd")                  ,
                                 "h_alta"                      => date("H:i:s")                ,
                                 "i_usuario_alta"              => $i_usuario_actualiza         );
								 
    // codificacion de la contrasena
	$lacontrasena = "PASSWORD('".$contrasena."')";
    $this->db->set('contrasena', $lacontrasena, FALSE);    

    // se actualizan los datos del usuario
    $this->db->where("i_usuario", $i_usuario);
    $this->db->update("s_usuario", $usuario_actualizado);
    
    // se actualizan los datos de la cuenta de la persona
    $cuenta_actualizada = array("nombre"             => $nombre              ,
                                "apellido_paterno"   => $apellido_paterno    ,
                                "apellido_materno"   => $apellido_materno    ,
                                "email"              => $email               ,
                                "email_secundario"   => $email_secundario    ,
                                "img_avatar"         => $img_avatar          ,
                                "genero"             => $genero              ,
                                "tipo_cuenta"        => $tipo_cuenta         ,
                                "i_estado_registro"  => $i_estado_registro   ,
                                "f_alta"             => date("Ymd")          ,
                                "h_alta"             => date("H:i:s")        ,
                                "i_usuario"          => $i_usuario_actualiza );

    // se acualizan los datos de la cuenta de la persona
    $this->db->where("i_cuenta", $i_usuario);
    $this->db->insert("cuenta_persona", $cuenta_actualizada);
  }

    // registro de cuenta de usuario en el sistema  
  public function f_cambia_contrasena_usuario($i_usuario, $contrasena, $pista_recupera_contrasena, $palabra_recupera_contrasena)
  {
  
/*
  i_usuario                   INTEGER, -- llave
  i_cuenta                    INTEGER, -- relacion a cuenta personal
  login                       CHAR(20), -- clave de usuario alfanumerica
  contrasena                  CHAR(20), -- contrasena
  pista_recupera_contrasena   CHAR(200), -- pregunta para recuperar contrasena
  palabra_recupera_contrasena CHAR(30), -- respuesta recuperar contrasena
  i_estado_registro               SMALLINT, -- estado de la cuenta: activa, inactiva, bloqueada
  i_usuario_alta              INTEGER, -- usuario que genero la cuenta de usuario
  f_alta                      DATE, -- fecha en que se creo la cuenta
  h_alta                      TIME,
*/
  
    // se prepara el arreglo para actualizar al usuario
    $usuario_actualizado = array("pista_recupera_contrasena"   => $pista_recupera_contrasena   ,
                                 "palabra_recupera_contrasena" => $palabra_recupera_contrasena );
								 
    // codificacion de la contrasena
	$lacontrasena = "PASSWORD('".$contrasena."')";
    $this->db->set('contrasena', $lacontrasena, FALSE);    

    // se actualizan los datos del usuario
    $this->db->where("i_usuario", $i_usuario);
    $this->db->update("s_usuario", $usuario_actualizado);

  }
  
  // cambiar la imagen de avatarl del usuario
  public function f_cambia_avatar_usuario($i_usuario, $avatar_usuario)
  {
  
    // se prepara el arreglo para actualizar al usuario
    $usuario_actualizado = array("img_avatar"   => $avatar_usuario);

    // se actualizan los datos del usuario
    $this->db->where("i_cuenta", $i_usuario);
    $this->db->update("cuenta_persona", $usuario_actualizado);

  }
  
  // obtiene el login de un usuario identificado por su i_usuario
  public function f_login_usuario($i_usuario)
  {
    $ls_sql = "SELECT login FROM s_usuario WHERE i_usuario = ".$i_usuario;
    
    $query = $this->db->query($ls_sql);
    
    $elregistro = $query->row();
    
    $el_login = $elregistro->login;
    
    // se libea el cursor
    $query->free_result();
    
    // se devuelve el login
    return $el_login;
  }
  
  public function f_valida_login($user_login, $password)
  {  
    // query the database for a registered user with user_login and password
    $ls_sql = "SELECT id AS usuario FROM jos_users WHERE username = '".$user_login."' AND password = MD5('".$password."')";

    // run the query instruction
    $query = $this->db->query($ls_sql);
    
    if ($query->num_rows() > 0)
    {
       $unUsuario = $query->row();
       $i_usuario = $unUsuario->usuario;
       
       // se libera el cursor
       $query->free_result();
       
       // se devuelve la clave de usuario
       return $i_usuario;
    } 
    else
    {
       // se libera el resultado
       $query->free_result();
       
       // se devuelve nulo, el usuario no pudo ser validado
       return null;
    } 
  }
  
  public function f_valida_caducidad_cuenta($user_login, $password)
  {  
    // se verifica si la cuenta caduca y su fecha de caducidad
    $ls_sql = "SELECT b_cuenta_caduca, f_caducidad FROM s_usuario WHERE login='".$user_login."' AND contrasena='".$password."'";
    
    // run the query instruction
    $query = $this->db->query($ls_sql);
    
    $datosCaducidad = $query->row();
    
    // se libera el cursor
    $query->free_result();
    
    // se devuelven los datos de caducidad
    return $datosCaducidad;
  }
  
  public function f_obtiene_nombre_usuario($i_usuario)
  {
    
      // se obtiene el nombre de la cuenta
      $ls_sql = "SELECT nombre FROM cuenta_persona WHERE i_cuenta = ".$i_usuario;
      
      $result = $this->db->query($ls_sql);
      
      // se pide el registro
      $unNombre = $result->row();
      
      // el nombre de la cuenta
      $nombre = $unNombre->nombre;
      
      $result->free_result();

    // se devuelve el nombre encontrado
    return $nombre;
  }
  
  public function f_obtiene_avatar_usuario($i_usuario)
  {
    
      // se obtiene el avatar de la cuenta
      $ls_sql = "SELECT img_avatar FROM cuenta_persona WHERE i_cuenta = ".$i_usuario;
      
      $result = $this->db->query($ls_sql);
      
      // se pide el registro
      $unAvatar = $result->row();
      
      // img del avayar del usuario
      $avatar_usuario = $unAvatar->img_avatar;
      
      $result->free_result();
    // se devuelve el nombre encontradO
    return $avatar_usuario;
  }
  
  // obtener degradado de fondo que el usuario eligio
  public function f_obtiene_color_fondo_usuario($i_usuario)
  {
    
      // se obtiene el avatar de la cuenta
      $ls_sql  = " SELECT ccf.color1, ccf.color2, ccf.color3, ccf.color4, ccf.color5";
	  $ls_sql .= " FROM c_color_fondo ccf, param_pantalla_usuario ppu";
	  $ls_sql .= " WHERE ppu.i_usuario = ".$i_usuario;
	  $ls_sql .= " AND   ppu.i_color_fondo = ccf.i_color_fondo";
      
      $result = $this->db->query($ls_sql);
      
      // se pide el registro
      $colores = $result->row();
      
      $color_fondo = "ffffff";
      
      if ( $colores != null ) {
      
      // clausulas para el fondo
      $color_fondo  = "\n background: #".$colores->color1."; /* Old browsers */";
	  $color_fondo .= "\n background: -moz-linear-gradient(-45deg,  #".$colores->color1." 0%, #".$colores->color2." 9%, #".$colores->color3." 50%, #".$colores->color4." 91%, #".$colores->color5." 100%); /* FF3.6-15 */";
      $color_fondo .= "\n background: -webkit-linear-gradient(-45deg,  #".$colores->color1." 0%,#".$colores->color2." 9%,#".$colores->color3." 50%,#".$colores->color4." 91%,#".$colores->color5." 100%); /* Chrome10-25,Safari5.1-6 */";
      $color_fondo .= "\n background: linear-gradient(135deg,  #".$colores->color1." 0%,#".$colores->color2." 9%,#".$colores->color3." 50%,#".$colores->color4." 91%,#".$colores->color5." 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */";
      $color_fondo .= "\n filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#".$colores->color1."', endColorstr='#".$colores->color5."',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */";
      

/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#d0e4f7+0,73b1e7+9,0a77d5+50,539fe1+91,87bcea+100 */
//background: #d0e4f7; /* Old browsers */
//background: -moz-linear-gradient(-45deg,  #d0e4f7 0%, #73b1e7 9%, #0a77d5 50%, #539fe1 91%, #87bcea 100%); /* FF3.6-15 */
//background: -webkit-linear-gradient(-45deg,  #d0e4f7 0%,#73b1e7 9%,#0a77d5 50%,#539fe1 91%,#87bcea 100%); /* Chrome10-25,Safari5.1-6 */
//background: linear-gradient(135deg,  #d0e4f7 0%,#73b1e7 9%,#0a77d5 50%,#539fe1 91%,#87bcea 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
//filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d0e4f7', endColorstr='#87bcea',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
      }

	  
	  
      $result->free_result();
	  //die($color_fondo);
    // se devuelve el css para el color de fondo
    return $color_fondo;
  }
  
  // inicio de sesion
  public function f_inicio_sesion($i_usuario) {
      // se inserta el registro de usuario en la tabla de sesiones
      $fecha_sesion = date("Ymd");
      $hora_sesion  = date("H:i:s");
      
      // nueva sesion de usuario
      $nueva_sesion = array("i_usuario" => $i_usuario    ,
                            "f_sesion"  => $fecha_sesion ,
                            "h_sesion"  => $hora_sesion  );
      
      // se inserta el privilegio del usuario
      $lb_insercion_correcta = $this->db->insert("usuario_sesion_activa", $nueva_sesion);
      
      if ( $lb_insercion_correcta ) {
         // se inserta el movimiento en la tabla historica
         $nueva_sesion = array("i_sesion_historico" => 0             ,
                               "i_usuario"          => $i_usuario    ,
                               "f_sesion"           => $fecha_sesion ,
                               "h_sesion"           => $hora_sesion  ,
                               "i_tipo_movimiento"  => 1             );
         
         // se inserta el privilegio del usuario
         $lb_insercion_correcta = $this->db->insert("usuario_sesion_historico", $nueva_sesion);
         
         return true;
        
      } else
      {
          return false;
      }
      
  }
  
  public function f_cerrar_sesion($i_usuario) {
    // se borra el usaurio de la tabla de sesiones activas
    $this->db->where('i_usuario', $i_usuario);
    $this->db->delete('usuario_sesion_activa');
    
    // se inserta el movimiento de cierre de sesion
    $fecha_sesion = date("Ymd");
    $hora_sesion  = date("H:i:s");
    $nueva_sesion = array("i_sesion_historico" => 0             ,
                          "i_usuario"          => $i_usuario    ,
                          "f_sesion"           => $fecha_sesion ,
                          "h_sesion"           => $hora_sesion  ,
                          "i_tipo_movimiento"  => 2             );
                          
    $lb_insercion_correcta = $this->db->insert("usuario_sesion_historico", $nueva_sesion);
    
  }

}



?>