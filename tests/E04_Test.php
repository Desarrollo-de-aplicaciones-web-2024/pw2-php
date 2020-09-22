<?php
require_once 'Pruebas.php';

class E04_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio4.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        require_once $this->archivo;

        $this->assertTrue(isset($numero1), 'Variable $numero1 no establecida');
        $this->assertTrue(isset($numero2), 'Variable $numero2 no establecida');

        $this->assertNotEmpty($numero1, 'Variable $numero1 sin valor (no asignes valor cero)');
        $this->assertNotEmpty($numero2, 'Variable $numero2 sin valor (no asignes valor cero)');

        $this->assertTrue(isset($suma), 'Variable $suma no establecida');
        $this->assertTrue(isset($resta), 'Variable $resta no establecida');
        $this->assertTrue(isset($multiplicacion), 'Variable $multiplicacion no establecida');
        $this->assertTrue(isset($division), 'Variable $division no establecida');


        $this->assertEquals($numero1 + $numero2, $suma, 'La variable $suma tiene un valor incorrecto');
        $this->assertEquals($numero1 - $numero2, $resta, 'La variable $resta tiene un valor incorrecto');
        $this->assertEquals($numero1 * $numero2, $multiplicacion, 'La variable $multiplicacion tiene un valor incorrecto');
        $this->assertEquals($numero1 / $numero2, $division, 'La variable $division tiene un valor incorrecto');
    }

}
