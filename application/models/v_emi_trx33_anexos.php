<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_emi_trx33_anexos extends ORM {
        public $table = "v_emi_trx33_anexos";
        public $primary_key = 'id_trx33';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33'                    => ORM::field('int'),
                        'id_anexo'                    => ORM::field('int'),
                        'nombre_anexo'                => ORM::field('char[1024]'),
                        'ext_archivo'                 => ORM::field('char[10]'),
                        'anexo'                       => ORM::field('blob')
                );
        }
}

?>
