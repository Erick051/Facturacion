<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Biblioteca para la lectura de archivo csv
 * 
 */
 
class CSVReader {

    var $fields;/** columns names retrieved after parsing */
    var $separator = ',';/** separator used to explode each line */
    var $enclosure = '"';/** enclosure used to decorate each field */
    var $max_row_size = 4096;/** maximum row size to be used for decoding */

    function parse_file($p_Filepath, $separator = ",", $enclosure = '"', $max_row_size = 4096, $line_number = null) {

        $file = fopen($p_Filepath, 'r');
        
        // lectura de las dos lineas
//array fgetcsv ( resource $handle [, int $length = 0 [, string $delimiter = "," [, string $enclosure = '"' [, string $escape = "\" ]]]] )
        
        $encabezado = fgetcsv($file, 0, $separator, $enclosure);
        $encabezado = array_map("utf8_encode", $encabezado); // 20170313 se agrega para considerar condificacion con acentos y demas
        $muestra = fgetcsv($file, 0, $separator, $enclosure);
        $muestra = array_map("utf8_encode", $muestra); // 20170313 se agrega para considerar condificacion con acentos y demas
        fclose($file);
        
        $datos_archivo_csv = array();
        $datos_archivo_csv["encabezado"] = $encabezado;
        $datos_archivo_csv["muestra"]    = $muestra;
        
        return $datos_archivo_csv;
    }

}
?>