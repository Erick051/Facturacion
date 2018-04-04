<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_r_usuario_cliente extends ORM {
        public $table_name = "pss_r_usuario_cliente";
        public $primary_key = 'id_r_usuario_cliente';

        function _init()
        {
                self::$fields = array(
                        'id_r_usuario_cliente' => ORM::field('auto[11]'),
                        'id_usuario'           => ORM::field('int'),
                        'id_cliente'           => ORM::field('int'),
                        'fecha_alta'           => ORM::field('datetime')
                );
        }
}

?>
