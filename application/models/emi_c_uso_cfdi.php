<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_c_uso_cfdi extends ORM {
        public $table_name = "emi_c_uso_cfdi";
        public $primary_key = 'id_uso_cfdi';

        function _init()
        {
                self::$fields = array(
                        'id_uso_cfdi'     => ORM::field('char[4]'),
                        'descripcion'     => ORM::field('char[200]'),
                        'fisica'          => ORM::field('char[4]'),
                        'moral'           => ORM::field('char[4]'),
                        'fecha_inicio'    => ORM::field('timestamp'),
                        'fecha_fin'       => ORM::field('timestamp')
                );
        }
}

?>
