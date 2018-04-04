<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class C_etapas_procesos extends ORM {
        public $table = "c_etapas_procesos";
        public $primary_key = 'id_etapa_proceso';
        
        function _init()
        {

                self::$fields = array(
                        'id_etapa_proceso'          => ORM::field('int'),
                        'secuencia'                 => ORM::field('int'),
                        'id_programa'               => ORM::field('int'),
                        'id_proceso'                => ORM::field('int'),
                        'id_etapa_anterior'         => ORM::field('int'),
                        'id_etapa_siguiente'        => ORM::field('int'),
                        'archivo_config_externo'    => ORM::field('char[255]'),
                        'envia_notificacion_email'  => ORM::field('int'),
                        'ruta_entrada'              => ORM::field('char[255]'),
                        'ruta_salida_estandar'      => ORM::field('char[255]'),
                        'ruta_salida_error'         => ORM::field('char[255]'),
                        'extension_archivo_entrada' => ORM::field('char[10]'),
                        'extension_archivo_salida'  => ORM::field('char[10]'),
                        'ruta_archivo_log'          => ORM::field('char[255]'),
                        'id_tipo_ejecucion'         => ORM::field('int')
                );
        }
}

?>
