<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Consulta_mapeo_csv_nomina12 extends ORM {
        public $table = "v_consulta_mapeo_csv_nomina12";
        public $primary_key = 'id_mapeo_layout_csv_nomina12';
        
        function _init()
        {
            
                self::$fields = array(
                        'id_mapeo_layout_csv_nomina12' => ORM::field('auto[11]'),
                        'id_mapeo_layout_padre'        => ORM::field('int'),
                        'campo_layout'                 => ORM::field('char[40]'),
                        'indice_en_archivo'            => ORM::field('int'),
                        'id_seccion'                   => ORM::field('int'),
                        'seccion'                      => ORM::field('char[30]'),
                        'dato_muestra'                 => ORM::field('string')
                );
        }
}

?>
