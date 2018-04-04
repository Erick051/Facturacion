<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_pss_listado_comprobantes_autofactura_1 extends ORM {
        public $table = "v_pss_listado_comprobantes_autofactura";
        public $primary_key = 'id_trx33';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33'          => ORM::field('int'),
                        'rfc_emisor'        => ORM::field('char[15]'),
                        'nombre_emisor'     => ORM::field('char[255]'),
                        'rfc_receptor'      => ORM::field('char[15]'),
                        'nombre_receptor'   => ORM::field('char[255]'),
                        'serie'             => ORM::field('char[40]'),
                        'folio'             => ORM::field('char[40]'),
                        'uuid'              => ORM::field('char[50]'),
                        'fecha_timbrado'    => ORM::field('datetime'),
                        'moneda'            => ORM::field('char[50]'),
                        'total'             => ORM::field('decimal')


                );
        }
}

?>
