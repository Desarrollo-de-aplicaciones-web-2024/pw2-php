<?php
require_once 'Pruebas.php';

class E10_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio10.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();




        $output = self::php_to_string($this->archivo);

        $str = str_ireplace(self::DOC_TYPE, '', $output);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($str);

        $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

        $p = $doc->getElementsByTagName('p');

        $this->assertEquals(32, count($p), 'Deben haber 32 párrafos');

        $c = 0;
        $x = 1;
        foreach($p as $parrafos){
            $color = $parrafos->getAttribute('style');

            $this->assertStringContainsStringIgnoringCase("$c", $color, "Color incorrecto en el párrafo número $x");
            $c += 8;
            $x++;
        }

    }

}
