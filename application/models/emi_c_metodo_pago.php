<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_c_metodo_pago extends ORM {
        public $table_name = "emi_c_metodo_pago";
        public $primary_key = 'id_metodo_pago';

        function _init()
        {
                self::$fields = array(
                        'id_metodo_pago'  => ORM::field('char[5]'),
                        'descripcion'      => ORM::field('char[50]')
                );
        }
}

?>
