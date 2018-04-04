<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Etapa_proceso extends ORM {

        public $primary_key = 'id_etapa_proceso';

        function _init()
        {
                self::$fields = array(
                        'id_ejecucion'                              => ORM::field('auto[11]'),
                        'id_proceso'                                => ORM::field('int'),
                        'id_etapa'                                  => ORM::field('int'),
                        'nombre_etapa'                              => ORM::field('char[255]'),
                        'desc_etapa'                                => ORM::field('char[255]'),
                        'id_programa'                               => ORM::field('int'),
                        'id_etapa_anterior'                         => ORM::field('int'),
                        'id_estapa_siguiente'                       => ORM::field('int'),
                        'id_tipo_ejecucion'                         => ORM::field('int'),
                        'archivo_config_externo'                    => ORM::field('char[255]'),
                        'envia_notificacion_email'                  => ORM::field('int'),
                        'destinatario_email_finaliza_correcto'      => ORM::field('char[255]'),
                        'destinatario_email_finaliza_observaciones' => ORM::field('char[255]'),
                        'destinatario_email_finaliza_error'         => ORM::field('char[255]'),
                        'ruta_entrada'                              => ORM::field('char[255]'),
                        'ruta_salida_estandar'                      => ORM::field('char[255]'),
                        'ruta_salida_error'                         => ORM::field('char[255]'),
                        'extension_archivo_entrada'                 => ORM::field('char[255]'),
                        'extension_archivo_salida'                  => ORM::field('char[5]'),
                        'ruta_archivo_log'                          => ORM::field('char[]')
                );
        }
}

?>
