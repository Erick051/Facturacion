<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_pss_c_entidades extends ORM {
        public $table_name = "v_pss_c_entidades";
        public $primary_key = 'id_entidad';

        function _init()
        {
                self::$fields = array(
                        'id_entidad'        => ORM::field('int'),
                        'rfc'               => ORM::field('char[20]'),
                        'entidad'           => ORM::field('char[50]'),
                        'tipo_entidad'      => ORM::field('char[15]')
                        
                );
        }
}

?>
