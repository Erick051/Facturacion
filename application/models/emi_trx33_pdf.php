<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_pdf extends ORM {
        public $table = "emi_trx33_pdf";
        public $primary_key = 'id_trx33';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33'              => ORM::field('int'),
                        'pdf'                   => ORM::field('binary'),
                        'creado'                => ORM::field('int')
                );
        }
}

?>
