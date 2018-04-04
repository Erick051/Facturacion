<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Encriptada extends ORM {
        public $table = "encriptada";
        public $primary_key = 'id_encriptado';
        
        function _init()
        {
            
                self::$fields = array(
                        'id_encriptado'            => ORM::field('auto[11]'),
                        'campo_no_encriptado'      => ORM::field('char[100]'),
                        'campo_encriptado'         => ORM::field('char[30]')
                );
        }
}

?>