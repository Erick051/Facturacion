<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Envio_correo_adjuntos extends ORM {

        public $primary_key = 'id_correo_adjunto';

        function _init()
        {
                self::$fields = array(
                        'id_correo_adjunto'     => ORM::field('auto[11]'),
                        'id_envio_correo'       => ORM::field('int'),
                        'tipo_adjunto'          => ORM::field('int'),
                        'forma_adjunto'         => ORM::field('int'),
                        'adjunto_text'          => ORM::field('string'),
                        'adjunto_blob'          => ORM::field('string'),
                        'nombre_adjunto'        => ORM::field('char[200]')
                );
        }
}

?>
