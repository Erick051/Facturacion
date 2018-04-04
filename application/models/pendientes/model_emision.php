<?php

// modelo para administrar las cuentas de usuario

class model_usuario extends CI_model {

  // obtiene la lista de usuarios del tipo de cuenta recibido por parametro
  public function f_obtener_lista_usuarios()
  {
    // se obtienen los datos de la cuenta de usuario y la persona
    $ls_sql =          " SELECT   s_usuario.*, cuenta_persona.*, ";
	$ls_sql = $ls_sql. "          cer.d_estado_registro ";
    $ls_sql = $ls_sql. " FROM     s_usuario JOIN cuenta_persona ";
    $ls_sql = $ls_sql. " ON       s_usuario.i_cuenta = cuenta_persona.i_cuenta ";
	$ls_sql = $ls_sql. "          JOIN c_estado_registro cer";
	$ls_sql = $ls_sql. " ON       s_usuario.i_estado_registro = cer.i_estado_registro";
    $ls_sql = $ls_sql. " ORDER BY s_usuario.login";

    $result_usuarios = $this->db->query($ls_sql);

    // se inicia el contador de usuarios
    $num_usuarios = 1;
    
    $arr_usuarios = array();
    
    // se obtienen los datos de cada plantel encontrado
    foreach ( $result_usuarios->result() as $unUsuario)
    {
    
      $arr_usuarios[$num_usuarios] = array("i_usuario"                    => $unUsuario->i_usuario                  ,
                                           "i_cuenta"                     => $unUsuario->i_cuenta                   ,
                                           "login"                        => $unUsuario->login                      ,
                                           "contrasena"                   => $unUsuario->contrasena                 ,
                                           "pista_recupera_contrasena"    => $unUsuario->pista_recupera_contrasena  ,
                                           "palabra_recupera_contrasena"  => $unUsuario->palabra_recupera_contrasena,
                                           "i_estado_registro"            => $unUsuario->i_estado_registro          ,
										   "d_estado_registro"            => $unUsuario->d_estado_registro          ,
                                           "nombre"                       => $unUsuario->nombre                     ,
                                           "apellido_paterno"             => $unUsuario->apellido_paterno           ,
                                           "apellido_materno"             => $unUsuario->apellido_materno           ,
                                           "email"                        => $unUsuario->email                      ,
                                           "email_secundario"             => $unUsuario->email_secundario           ,
                                           "img_avatar"                   => $unUsuario->img_avatar                 ,
                                           "genero"                       => $unUsuario->genero                     ,
                                           "tipo_cuenta"                  => $unUsuario->tipo_cuenta                ,
                                           "i_usuario_alta"               => $unUsuario->i_usuario_alta             ,
										   "b_cuenta_caduca"              => $unUsuario->b_cuenta_caduca            ,
										   "f_caducidad"                  => $unUsuario->f_caducidad                ,
                                           "f_alta"                       => $unUsuario->f_alta                     ,
                                           "h_alta"                       => $unUsuario->h_alta                     );

      // se incrementa el contador
      $num_usuarios = $num_usuarios + 1;
    }
    
    // se libera el cursor
    $result_usuarios->free_result();
  
    // se devuelve el arreglo con la lista de usuarios
    return $arr_usuarios;
  }

// obtiene los datos de un usuario
  public function f_obtener_datos_usuario($i_usuario)
  {
    // se obtienen los datos de la cuenta de usuario y la persona
    $ls_sql =          " SELECT   su.i_usuario, su.i_cuenta, su.login, su.contrasena, su.pista_recupera_contrasena, su.palabra_recupera_contrasena, ";
    $ls_sql = $ls_sql. "          su.i_estado_registro, su.i_usuario_alta, ced.d_estado_registro, su.b_cuenta_caduca, if (su.b_cuenta_caduca = 1, 'CADUCA','SIN CADUCIDAD') as b_cuenta_caduca,";
    $ls_sql = $ls_sql. "          su.f_caducidad, su.f_ultima_sesion, if(su.primer_inicio_sesion = 1,'SI','NO') as primer_inicio_sesion, su.f_alta, su.h_alta,";
    $ls_sql = $ls_sql. "          cp.nombre, cp.apellido_paterno, cp.apellido_materno, cp.email, cp.email_secundario, cp.genero, if(cp.genero = 'H','Hombre','Mujer') as d_genero, cp.tipo_cuenta, if(cp.genero = 'A','Alumno','Profesor') as d_tipo_cuenta, ifnull(cp.img_avatar,'avatar_generico.png') as img_avatar";
    $ls_sql = $ls_sql. " FROM     s_usuario su JOIN cuenta_persona cp";
    $ls_sql = $ls_sql. " ON       su.i_cuenta = cp.i_cuenta ";
    $ls_sql = $ls_sql. " JOIN     c_estado_registro ced";
    $ls_sql = $ls_sql. " ON       su.i_estado_registro = ced.i_estado_registro ";
    $ls_sql = $ls_sql. " WHERE    su.i_usuario = ".$i_usuario;

    
    //echo "<br><br><br><br><br><br><br><br>".$ls_sql;
    
    // se ejcuta la consulta del usuario
    $result_usuario = $this->db->query($ls_sql);
    
    // se obtiene el registro
    $datos_usuario = $result_usuario->row();

    // se libera el cursor
    $result_usuario->free_result();
    
    //print_r($datos_usuario);
  
    // se devuelve el arreglo con los datos del usuario
    return $datos_usuario;
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