<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_pss_series_entidades extends ORM {
        public $table_name = "v_pss_series_entidades";
        public $primary_key = 'id_serie_entidad';

        function _init()
        {
                self::$fields = array(
                        'id_serie_entidad'  => ORM::field('auto[11]'),
                        'id_entidad'        => ORM::field('int'),
                        'rfc'               => ORM::field('char[20]'),
                        'entidad'           => ORM::field('char[50]'),
                        'tipo_entidad'      => ORM::field('char[15]'),
                        'serie'             => ORM::field('char[20]'),
                        'secuencia'         => ORM::field('char[40]')
                        
                );
        }
}

?>
