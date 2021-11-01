<?php
require_once 'Pruebas.php';

class E12_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio12.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        $str = file_get_contents( $this->archivo );

        $for = self::strpos_all($str, 'for');
        $while = self::strpos_all($str, 'while');

        $total = count($for) + count($while);

        $this->assertEquals(2, $total, 'Debes utilizar 2 ciclos for o while en la solución de este ejercicio');

        $output = self::php_to_string($this->archivo);

        $str = str_ireplace(self::DOC_TYPE, '', $output);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($str);

        $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

        $table = $doc->getElementsByTagName('table');
        $this->assertEquals(1, count($table), 'Debe haber 1 tabla');

        $tr = $doc->getElementsByTagName('tr');
        $this->assertEquals(6, count($tr), 'Deben haber 6 elementos <tr>');

        $td = $doc->getElementsByTagName('td');
        $this->assertEquals(30, count($td), 'Deben haber 30 elementos <td>');

    }

    static function strpos_all($haystack, $needle) {
        $offset = 0;
        $allpos = array();
        while (($pos = strpos($haystack, $needle, $offset)) !== FALSE) {
            $offset   = $pos + 1;
            $allpos[] = $pos;
        }
        return $allpos;
    }

}
