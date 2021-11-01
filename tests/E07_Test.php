<?php
require_once 'Pruebas.php';

class E07_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio7.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        ob_start();
        require_once $this->archivo;
        ob_get_clean();

        $this->assertTrue(isset($colores), 'Variable $colores no establecida');
        $this->assertNotEmpty($colores, 'Variable $colores sin valor');
        $this->assertIsArray($colores, 'Variable $colores no es un arreglo');
        $this->assertEquals(7, count($colores), 'La cantidad de elementos en el arreglo $colores es incorrecta');

        $this->assertEquals('rojo', $colores[0], 'Posición 0 del arreglo colores tiene un valor incorrecto');
        $this->assertEquals('azul', $colores[1], 'Posición 1 del arreglo colores tiene un valor incorrecto');
        $this->assertEquals('amarillo', $colores[2], 'Posición 2 del arreglo colores tiene un valor incorrecto');
        $this->assertEquals('verde', $colores[3], 'Posición 3 del arreglo colores tiene un valor incorrecto');
        $this->assertEquals('negro', $colores[4], 'Posición 4 del arreglo colores tiene un valor incorrecto');
        $this->assertEquals('blanco', $colores[5], 'Posición 5 del arreglo colores tiene un valor incorrecto');
        $this->assertEquals('gris', $colores[6], 'Posición 6 del arreglo colores tiene un valor incorrecto');

        $output = self::php_to_string($this->archivo);

        $str = str_ireplace(self::DOC_TYPE, '', $output);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($str);

        $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

        $p = $doc->getElementsByTagName('p');
        $this->assertEquals(1, count($p), 'Debe haber 1 párrafo');

        $em = $doc->getElementsByTagName('em');
        $this->assertEquals(1, count($em), 'Debe haber 1 elemento <em>');

        $this->assertEquals('"Uso muy poco el rojo. Uso azul, amarillo, un poco de verde, pero especialmente... negro, blanco y gris. Hay una cierta necesidad en mí de comunicarme con los seres humanos. El blanco y el negro es escribir” – Jean Arp (1886 – 1966), artista.', $p[0]->nodeValue, 'El texto del párrafo es incorrecto');
    }

}
