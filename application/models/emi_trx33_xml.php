<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_xml extends ORM {
        public $table = "emi_trx33_xml";
        public $primary_key = 'id_trx33';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33'              => ORM::field('int'),
                        'xml'                   => ORM::field('string'),
                        'codigo'                => ORM::field('char[45]'),
                        'descripcion'           => ORM::field('string'),
                        'xml_timbrado'          => ORM::field('string'),
                        'fecha_peticion'        => ORM::field('timestamp'),
                        'fecha_respuesta'       => ORM::field('timestamp'),
                        'cadena_original'       => ORM::field('String'),
                        'sello_cfdi'            => ORM::field('String'),
                        'no_certificado_cfdi'   => ORM::field('char[100]'),
                        'certificado_cfdi'      => ORM::field('string'),
                        'sello_timbrado'        => ORM::field('string'),
                        'sello_sat'             => ORM::field('string'),
                        'no_certificado_sat'    => ORM::field('char[50]'),
                        'uuid'                  => ORM::field('char[50]'),
                        'fecha_timbrado'        => ORM::field('timestamp'),
                        'rfc_prov_certif'       => ORM::field('char[20]'),
                        'leyenda'               => ORM::field('string'),
                        'acuse_cancelacion'     => ORM::field('string')
                );
        }
}

?>
