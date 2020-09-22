<?php
require_once 'Pruebas.php';

class E02_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio2.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        require_once $this->archivo;

        $this->assertNotEmpty($var, 'Variable $var no establecida o sin valor');
        $this->assertEquals('Desarrollo web con PHP', $var, 'Valor de la variable $var incorrecto');
    }

}
