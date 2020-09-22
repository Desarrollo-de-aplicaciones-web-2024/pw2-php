<?php
require_once 'Pruebas.php';

class E01_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio1.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrect(){
        $this->testExisteArchivo();

        $contenido = file_get_contents($this->archivo);

        $existe = strpos($contenido, 'phpinfo()') !== false;

        $this->assertTrue($existe, 'No se encontró el llamado a la función phpinfo()');
    }

}
