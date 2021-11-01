<?php
require_once 'Pruebas.php';

class E11_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio11.php';

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

        $ul = $doc->getElementsByTagName('ul');
        $this->assertEquals(1, count($ul), 'Deben haber 1 elemento <ul>');

        $li = $doc->getElementsByTagName('li');
        $this->assertEquals(50, count($li), 'Deben haber 50 elementos <li>');

        $c = 0;
        $x = 1;
        $rojos = 0;
        $lista_rojos = array(3,9,15,21,27,33,39,45,51,57,63,69,75,81,87,93,99);
        $numeros = 0;
        foreach($li as $elemento){
            $color = $elemento->getAttribute('style');
            $numero = trim($elemento->nodeValue);

            if(strpos($color, 'red')){
                $rojos++;

                if(in_array($numero, $lista_rojos) !== false){
                    $numeros++;
                }
            }
        }

        $this->assertEquals(17, $numeros, 'Los múltiplos de 3 marcados con rojo son incorrectos');
        $this->assertEquals(17, $rojos, 'Deben haber 17 elementos con fuente roja');

    }

}
