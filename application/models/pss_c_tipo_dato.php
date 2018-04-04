<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_c_tipo_dato extends ORM {
        public $table = "pss_c_tipo_dato";
        public $primary_key = 'id_tipo_dato';
        
        function _init()
        {
                self::$fields = array(
                        'id_tipo_dato'     => ORM::field('int'),
                        'clave_tipo_dato'  => ORM::field('char[10]'),
                        'd_tipo_dato'      => ORM::field('char[20]')
                );
        }
}

?>
