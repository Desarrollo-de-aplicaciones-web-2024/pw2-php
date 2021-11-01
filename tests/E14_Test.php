<?php
require_once 'Pruebas.php';

class E14_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio14.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        ob_start();
        require_once $this->archivo;
        ob_get_clean();

        $this->assertTrue(isset($temperaturas), 'Variable $temperaturas no establecida');
        $this->assertNotEmpty($temperaturas, 'Variable $temperaturas sin valor');
        $this->assertIsArray($temperaturas, 'Variable $temperaturas no es un arreglo');
        $this->assertEquals(18, count($temperaturas), 'La variable $temperaturas debe contener 17 elementos');

        $str = file_get_contents( $this->archivo );

        $this->assertNotFalse( strpos($str, 'array_sum'), 'No se encontró el llamado a la función array_sum');
        $this->assertNotFalse( strpos($str, 'count'), 'No se encontró el llamado a la función count');
        $this->assertNotFalse( strpos($str, 'sort'), 'No se encontró el llamado a la función sort');
        $this->assertNotFalse( strpos($str, 'array_slice'), 'No se encontró el llamado a la función array_slice');
        $this->assertNotFalse( strpos($str, 'round'), 'No se encontró el llamado a la función round');


        $output = self::php_to_string($this->archivo);

        $str = str_ireplace(self::DOC_TYPE, '', $output);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($str);

        $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

        $ul = $doc->getElementsByTagName('ul');
        $this->assertEquals(1, count($ul), 'Debe haber 1 elemento <ul>');

        $li = $doc->getElementsByTagName('li');
        $this->assertEquals(3, count($li), 'Deben haber 3 elementos <li>');


        $this->assertEquals('La temperatura promedio es de: 30.56', $li[0]->nodeValue, 'El texto del primer elemento <li> es incorrecto');
        $this->assertEquals('Las 5 temperaturas más bajas: 16, 18, 19, 24 y 25', $li[1]->nodeValue, 'El texto del segundo elemento <li> es incorrecto');
        $this->assertEquals('Las 5 temperaturas más altas: 44, 41, 39, 37 y 36', $li[2]->nodeValue, 'El texto del tercer elemento <li> es incorrecto');


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
