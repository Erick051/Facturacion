<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class C_tipo_inicio_sesion extends ORM {
        public $table_name = "c_tipo_inicio_sesion";
        public $primary_key = 'id_tipo_inicio_sesion';

        function _init()
        {
                self::$fields = array(
                        'id_tipo_inicio_sesion'  => ORM::field('auto[11]'),
                        'd_tipo_inicio_sesion'   => ORM::field('char[100]'),
                        'usar_email_como_login'  => ORM::field('int'),
                        'usar_contrasena'        => ORM::field('int')
                );
        }
}

?>
