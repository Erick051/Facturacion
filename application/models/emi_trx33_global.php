<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_global extends ORM {
        public $table = "emi_trx33_global";
        public $primary_key = 'idtrx33';
        
        function _init()
        {

                self::$fields = array(
                        'idtrx33'                      => ORM::field('int'),
                        'id_global'                    => ORM::field('int'),
                        'id_emisor'                    => ORM::field('int'),
                        'fecha_emision'                => ORM::field('datetime'),
                        'fecha_cfdi_global'            => ORM::field('datetime'),
                        'fecha_ejecucion'              => ORM::field('datetime'),
                        'fecha_extraccion_inicial'     => ORM::field('datetime'),
                        'fecha_extraccion_final'       => ORM::field('datetime'),
                        'frecuencia'                   => ORM::field('varchar[15]')
                );
        }
}

?>
