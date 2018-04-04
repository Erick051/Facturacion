<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_sucursal_marca extends ORM {
        public $table = "v_sucursal_marca";
        public $primary_key = 'party_id';
        
        function _init()
        {
            
                self::$fields = array(
                        'party_id'      => ORM::field('numeric'),
                        'party_name'    => ORM::field('sting'),
                        'marca'         => ORM::field('int')
                );
        }
}

?>
