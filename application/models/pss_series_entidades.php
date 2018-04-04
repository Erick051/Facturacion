<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_series_entidades extends ORM {
        public $table_name = "pss_series_entidades";
        public $primary_key = 'id_serie_entidad';

        function _init()
        {
                self::$fields = array(
                        'id_serie_entidad'                 => ORM::field('auto[11]'),
                        'serie'                            => ORM::field('char[20]'),
                        'id_entidad'                       => ORM::field('int')
                );
        }
}

?>
