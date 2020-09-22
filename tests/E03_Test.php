<?php
require_once 'Pruebas.php';

class E03_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio3.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        require_once $this->archivo;

        $this->assertTrue(isset($ligaHRef), 'Variable $ligaHRef no establecida');
        $this->assertNotEmpty($ligaHRef, 'Variable $ligaHRef sin valor');
        $this->assertEquals('http://php.net/', $ligaHRef, 'Valor de la variable $ligaHRef incorrecto');

        $this->assertTrue(isset($ligaTarget), 'Variable $ligaTarget no establecida');
        $this->assertNotEmpty($ligaTarget, 'Variable $ligaTarget sin valor');
        $this->assertEquals('_blank', $ligaTarget, 'Valor de la variable $ligaTarget incorrecto');

        $this->assertTrue(isset($ligaTitle), 'Variable $ligaTitle no establecida');
        $this->assertNotEmpty($ligaTitle, 'Variable $ligaTitle sin valor');
        $this->assertEquals('Ir al sitio de PHP', $ligaTitle, 'Valor de la variable $ligaTitle incorrecto');

        $this->assertTrue(isset($imagenSrc), 'Variable $imagenSrc no establecida');
        $this->assertNotEmpty($imagenSrc, 'Variable $imagenSrc sin valor');
        $this->assertEquals('http://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg', $imagenSrc, 'Valor de la variable $imagenSrc incorrecto');

        $this->assertTrue(isset($imagenWidth), 'Variable $imagenWidth no establecida');
        $this->assertNotEmpty($imagenWidth, 'Variable $imagenWidth sin valor');
        $this->assertEquals('350', $imagenWidth, 'Valor de la variable $imagenWidth incorrecto');

        $this->assertTrue(isset($imagenHeight), 'Variable $imagenHeight no establecida');
        $this->assertNotEmpty($imagenHeight, 'Variable $imagenHeight sin valor');
        $this->assertEquals('210', $imagenHeight, 'Valor de la variable $imagenHeight incorrecto');

        $this->assertTrue(isset($imagenALT), 'Variable $imagenALT no establecida');
        $this->assertNotEmpty($imagenALT, 'Variable $imagenALT sin valor');
        $this->assertEquals('Logotipo de PHP', $imagenALT, 'Valor de la variable $imagenALT incorrecto');
    }

}
