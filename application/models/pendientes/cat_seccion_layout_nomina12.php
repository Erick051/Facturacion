<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Cat_seccion_layout_nomina12 extends ORM {
        public $table = "cat_seccion_layout_nomina12";
        public $primary_key = 'id_seccion';
        
        function _init()
        {
                self::$fields = array(
                        'id_seccion' => ORM::field('auto[11]'),
                        'seccion'    => ORM::field('char[30]')
                );
        }
}

?>
