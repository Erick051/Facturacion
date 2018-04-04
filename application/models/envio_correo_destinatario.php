<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Envio_correo_destinatario extends ORM {

        public $primary_key = 'id_correo_destinatario';

        function _init()
        {
                self::$fields = array(
                        'id_correo_destinatario' => ORM::field('auto[11]'),
                        'id_envio_correo'        => ORM::field('int'),
                        'destinatario'           => ORM::field('email'),
                        'fecha_proceso'          => ORM::field('datetime'),
                        'estatus_envio'          => ORM::field('int'),
                        'cod_error'              => ORM::field('int'),
                        'd_error'                => ORM::field('string'),
                        'num_intentos'           => ORM::field('int')
                );
        }
}

?>
