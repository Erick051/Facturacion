<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_fh_transaccion extends ORM {
        public $table = "pss_fh_transaccion";
        public $primary_key = 'id_fh_transaccion';
        
        function _init()
        {

                self::$fields = array(
                        'id_fh_transaccion'     => ORM::field('auto'),
                        'id_flex_header'        => ORM::field('int'),
                        'etiqueta_flex_header'  => ORM::field('char[100]'),
                        'id_tipo_dato'          => ORM::field('int'),
                        'placeholder'           => ORM::field('char[100]')

                );
        }
}

?>
