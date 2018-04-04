<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class C_series_entidad extends ORM {
        public $table_name = "c_series_entidad";
        public $primary_key = 'id_serie_entidad';

        function _init()
        {
                self::$fields = array(
                        'id_entidad'         => ORM::field('auto[11]'),
                        'id_tipo_documento'  => ORM::field('int'),
                        'serie'              => ORM::field('char[20]'),
                        'secuencia'          => ORM::field('char[30]')
                );
        }
}

?>
