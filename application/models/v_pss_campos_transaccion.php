<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_pss_campos_transaccion extends ORM {
        public $table_name = "v_pss_campos_transaccion";
        public $primary_key = 'id_fh_transaccion';

        function _init()
        {
                self::$fields = array(
                        'id_fh_transaccion'     => ORM::field('auto[11]'),
                        'id_flex_header'        => ORM::field('int'),
                        'campo_adicional'       => ORM::field('char[70]'),
                        'descripcion'           => ORM::field('char[255]'),
                        'etiqueta_flex_header'  => ORM::field('auto[100]'),
                        'id_tipo_dato'          => ORM::field('int'),
                        'clave_tipo_dato'       => ORM::field('char[10]'),
                        'd_tipo_dato'           => ORM::field('char[20]')
                );
        }
}

?>
