<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_usuario extends ORM {
        public $table_name = "pss_usuario";
        public $primary_key = 'id_usuario_pss';

        function _init()
        {
                self::$fields = array(
                        'id_usuario_pss'                   => ORM::field('auto[11]'),
                        'login'                            => ORM::field('char[50]'),
                        'contrasena'                       => ORM::field('char[40]'),
                        'email'                            => ORM::field('char[50]'),
                        'nombre'                           => ORM::field('char[50]'),
                        'apellido_paterno'                 => ORM::field('char[50]'),
                        'apellido_materno'                 => ORM::field('char[50]'),
                        'id_pregunta_recuperacion'         => ORM::field('int'),
                        'respuesta_recuperar_contrasena'   => ORM::field('char[30]'),
                        'fecha_alta'                       => ORM::field('datetime'),
                        'fecha_ultima_sesion'              => ORM::field('datetime'),
                        'primer_inicio_sesion'             => ORM::field('int'),
                        'solicitar_cambio_contrasena'      => ORM::field('int'),
                        'id_estatus'                       => ORM::field('int'),
                        'dir_ip'                           => ORM::field('char[20]'),
                        'tipo_usuario'                     => ORM::field('int')
                );
        }
}

?>
