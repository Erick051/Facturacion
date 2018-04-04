<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_c_tipo_usuario extends ORM {
        public $table = "pss_c_tipo_usuario";
        public $primary_key = 'id_tipo_usuario';

        function _init()
        {
                self::$fields = array(
                        'id_tipo_usuario'     => ORM::field('int'),
                        'clave_tipo_usuario'  => ORM::field('char[50]'),
                        'd_tipo_usuario'      => ORM::field('char[250]')
                );
        }
}

?>
