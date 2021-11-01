<?php
require_once 'Pruebas.php';

class E08_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio8.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        ob_start();
        require_once $this->archivo;
        ob_get_clean();

        $this->assertTrue(isset($frutas), 'Variable $colores no establecida');
        $this->assertNotEmpty($frutas, 'Variable $colores sin valor');
        $this->assertIsArray($frutas, 'Variable $colores no es un arreglo');
        $this->assertEquals(7, count($frutas), 'La cantidad de elementos en el arreglo $colores es incorrecta');


        $str = file_get_contents( $this->archivo );

        $this->assertNotFalse( strpos($str, 'sort('), 'No se encontró la función de ordenamiento ascendente');
        $this->assertNotFalse( strpos($str, 'array_shift('), 'No se encontró la función para eliminar el primer elemento');
        $this->assertNotFalse( strpos($str, 'rsort('), 'No se encontró la función de ordenamiento descendiente');
        $this->assertNotFalse( strpos($str, 'print_r('), 'No se encontró la función de impresión');


        $output = self::php_to_string($this->archivo);

        $str = str_ireplace(self::DOC_TYPE, '', $output);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($str);

        $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

        $p = $doc->getElementsByTagName('p');

        $this->assertEquals(1, count($p), 'Debe haber 1 párrafo');
        $this->assertEquals('El arreglo $frutas tiene 7 elementos', $p[0]->nodeValue, 'El texto del párrafo es incorrecto' );

    }

}
