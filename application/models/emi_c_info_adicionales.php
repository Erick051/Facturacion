<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_c_info_adicionales extends ORM {
        public $table = "emi_c_info_adicionales";
        public $primary_key = 'id_info_adicional';
        
        function _init()
        {
                self::$fields = array(
                        'id_info_adicional' => ORM::field('int'),
                        'campo_adicional'   => ORM::field('char[70]'),
                        'descripcion'       => ORM::field('char[255]'),
                        'nivel'             => ORM::field('int')
                );
        }
}

?>
