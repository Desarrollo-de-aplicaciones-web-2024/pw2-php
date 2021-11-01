<?php
require_once 'Pruebas.php';

class E05_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio5.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        $nombre = 'Mundo';

        $output = self::php_to_string($this->archivo, array('nombre' => $nombre));

        $str = str_ireplace(self::DOC_TYPE, '', $output);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($str);

        $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

        $h1 = $doc->getElementsByTagName('h1');

        $this->assertEquals(1, count($h1), 'Debe haber 1 encabezado h1');
        $this->assertEquals("Hola $nombre", $h1[0]->nodeValue);
    }

}
