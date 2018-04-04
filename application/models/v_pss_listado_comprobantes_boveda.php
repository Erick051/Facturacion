<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_pss_listado_comprobantes_boveda extends ORM {
        public $table = "v_pss_listado_comprobantes_boveda";
        public $primary_key = 'id_docto';
        
        function _init()
        {

                self::$fields = array(
                        'id_docto'          => ORM::field('int'),
                        'version'           => ORM::field('char[5]'),
                        'rfc_emisor'        => ORM::field('char[15]'),
                        'nombre_emisor'     => ORM::field('char[255]'),
                        'rfc_receptor'      => ORM::field('char[15]'),
                        'nombre_receptor'   => ORM::field('char[255]'),
                        'pais_residencia'   => ORM::field('char[3]'),
                        'num_reg_id_trib'   => ORM::field('char[40]'),
                        'serie'             => ORM::field('char[40]'),
                        'folio'             => ORM::field('char[40]'),
                        'uuid'              => ORM::field('char[50]'),
                        'fecha_emision'     => ORM::field('datetime'),
                        'fecha_timbrado'    => ORM::field('datetime'),
                        'estatus'           => ORM::field('int'),
                        'fecha_cancelacion' => ORM::field('datetime'),
                        'moneda'            => ORM::field('char[50]'),
                        'tipo_cambio'       => ORM::field('decimal'),
                        'monto'             => ORM::field('decimal'),
                        'tipo_comprobante'  => ORM::field('char[20]'),
                        'forma_pago'        => ORM::field('char[10]'),
                        'metodo_pago'       => ORM::field('char[20]'),
                        'comentarios'       => ORM::field('string')


                );
        }
}

?>