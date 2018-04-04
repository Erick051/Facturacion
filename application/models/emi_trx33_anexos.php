<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_anexos extends ORM {
        public $table = "emi_trx33_anexos";
        public $primary_key = 'id_trx33';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33'                    => ORM::field('int'),
                        'id_anexo'                    => ORM::field('int'),
                        'nombre_anexo'                => ORM::field('varchar[1024]'),
                        'extension'                   => ORM::field('varchar[10]'),
                        'anexo'                       => ORM::field('blob')
                );
        }
}

?>
