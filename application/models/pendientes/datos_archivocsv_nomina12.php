<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Datos_archivocsv_nomina12 extends ORM {
        public $table = "datos_archivocsv_nomina12";
        public $primary_key = 'id_datos_archivo';
        
        function _init()
        {
                self::$fields = array(
                        'id_datos_archivo' => ORM::field('auto[11]'),
                        'tipo_dato'        => ORM::field('int'),
                        'indice'           => ORM::field('int'),
                        'valor'            => ORM::field('string')
                );
        }
}

?>
