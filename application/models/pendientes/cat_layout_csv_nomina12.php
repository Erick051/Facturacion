<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Cat_layout_csv_nomina12 extends ORM {
        public $table = "cat_layout_csv_nomina12";
        public $primary_key = 'id_cat_layout_csv_nomina12';
        
        function _init()
        {
                self::$fields = array(
                        'id_cat_layout_csv_nomina12' => ORM::field('auto[11]'),
                        'campo_layout'               => ORM::field('char[40]'),
                        'ocurrencias'                => ORM::field('int'),
                        'id_seccion'                 => ORM::field('int')
                );
        }
}

?>
