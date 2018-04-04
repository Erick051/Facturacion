<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_docto_xml extends ORM {
        public $table = "pss_docto_xml";
        public $primary_key = 'id_docto';
        
        function _init()
        {

                self::$fields = array(
                        'id_docto'  => ORM::field('auto'),
                        'version'   => ORM::field('char[5]'),
                        'xml'       => ORM::field('string')


                );
        }
}

?>
