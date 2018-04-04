<?php

// modelo para administrar las cuentas de usuario

class model_usuario extends CI_model {

  // obtiene la lista de usuarios del tipo de cuenta recibido por parametro
  public function f_obtener_menu()
  {
    // se obtienen los datos de la cuenta de usuario y la persona
    $ls_sql =          " select * from jos_menu where level = 1 and published = 1; ";

    $result_menu = $this->db->query($ls_sql);

    // se inicia el contador de menu
    $num_menu = 1;
    
    $arr_menu = array();
    
    // se obtienen los datos de cada menu encontrado
    foreach ( $result_menu->result() as $unMenu)
    {
    
id
menutype
title
alias
note
path
link
type
published
parent_id
level
component_id
ordering
checked_out
checked_out_time
browserNav
access
img
template_style_id
params
lft
rgt
home
language
client_id
neon_link
    
    
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

}



?>