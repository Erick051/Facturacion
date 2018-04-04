<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_pss_entidades extends ORM {
        public $table_name = "v_pss_entidades";
        public $primary_key = 'id_entidad';

        function _init()
        {
                self::$fields = array(
                        'id_entidad'    => ORM::field('auto[11]'),
                        'entidad'       => ORM::field('char[360]')
                );
        }
}

?>
