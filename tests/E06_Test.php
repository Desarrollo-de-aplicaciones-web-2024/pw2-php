<?php
require_once 'Pruebas.php';

class E06_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio6.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        ob_start();
        require_once $this->archivo;
        ob_get_clean();

        $this->assertTrue(isset($ana), 'Variable $ana no establecida');
        $this->assertNotEmpty($ana, 'Variable $ana sin valor');
        $this->assertEquals(8000, $ana, 'Valor de la variable $ana incorrecto');

        $this->assertTrue(isset($brenda), 'Variable $brenda no establecida');
        $this->assertNotEmpty($brenda, 'Variable $brenda sin valor');
        $this->assertEquals(10000, $brenda, 'Valor de la variable $brenda incorrecto');

        $this->assertTrue(isset($carolina), 'Variable $carolina no establecida');
        $this->assertNotEmpty($carolina, 'Variable $carolina sin valor');
        $this->assertEquals(6000, $carolina, 'Valor de la variable $carolina incorrecto');

        $output = self::php_to_string($this->archivo);

        $str = str_ireplace(self::DOC_TYPE, '', $output);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($str);

        $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

        $table = $doc->getElementsByTagName('table');
        $this->assertEquals(1, count($table), 'Debe haber 1 tabla');

        $tr = $doc->getElementsByTagName('tr');
        $this->assertEquals(3, count($tr), 'Debe haber 3 filas');

        $tds = $doc->getElementsByTagName('td');
        $this->assertEquals(6, count($tds), 'Debe haber 6 celdas');

        $this->assertEquals('Ana', $tds[0]->nodeValue, 'Celda 1,1 con el texto incorrecto');
        $this->assertEquals('$8000', $tds[1]->nodeValue, 'Celda 1,2 con el texto incorrecto');

        $this->assertEquals('Brenda', $tds[2]->nodeValue, 'Celda 2,1 con el texto incorrecto');
        $this->assertEquals('$10000', $tds[3]->nodeValue, 'Celda 2,2 con el texto incorrecto');

        $this->assertEquals('Carolina', $tds[4]->nodeValue, 'Celda 3,1 con el texto incorrecto');
        $this->assertEquals('$6000', $tds[5]->nodeValue, 'Celda 3,2 con el texto incorrecto');

    }

}
