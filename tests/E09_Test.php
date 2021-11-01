<?php
require_once 'Pruebas.php';

class E09_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio9.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        ob_start();
        require_once $this->archivo;
        ob_get_clean();

        $this->assertTrue(isset($usuario), 'Variable $usuario no establecida');
        $this->assertNotEmpty($usuario, 'Variable $usuario sin valor');
        $this->assertIsString($usuario, 'Variable $usuario no es un string');
        $this->assertEquals('ruben_sanchez', $usuario, 'El valor de la variable $usuario es incorrecto');


        $this->assertTrue(isset($correo), 'Variable $correo no establecida');
        $this->assertNotEmpty($correo, 'Variable $correo sin valor');
        $this->assertIsString($correo, 'Variable $correo no es un string');
        $this->assertEquals('rsanchez@ucc', $correo, 'El valor de la variable $correo es incorrecto');

        $this->assertTrue(isset($contraseña1), 'Variable $contraseña1 no establecida');
        $this->assertNotEmpty($contraseña1, 'Variable $contraseña1 sin valor');
        $this->assertIsString($contraseña1, 'Variable $contraseña1 no es un string');
        $this->assertEquals('abc12', $contraseña1, 'El valor de la variable $contraseña1 es incorrecto');

        $this->assertTrue(isset($contraseña2), 'Variable $contraseña2 no establecida');
        $this->assertNotEmpty($contraseña2, 'Variable $contraseña2 sin valor');
        $this->assertIsString($contraseña2, 'Variable $contraseña2 no es un string');
        $this->assertEquals('abc123', $contraseña2, 'El valor de la variable $contraseña2 es incorrecto');



        $str = file_get_contents( $this->archivo );

        $this->assertNotFalse( strpos($str, 'strtolower('), 'No se encontró la función para convertir a minúsculas');
        $this->assertNotFalse( strpos($str, 'str_replace('), 'No se encontró la función para reemplazar caracteres');

        $this->assertNotFalse( strpos($str, 'strpos('), 'No se encontró la función para ubicar un substring dentro de un string');

        $this->assertNotFalse( strpos($str, 'trim('), 'No se encontró la función para remover los espacios en blanco al inicio y al final de un string');
        $this->assertNotFalse( strpos($str, 'strlen('), 'No se encontró la función para calcular la longitud de una cadena');


        $output = self::php_to_string($this->archivo);

        $str = str_ireplace(self::DOC_TYPE, '', $output);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($str);

        $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

        $p = $doc->getElementsByTagName('p');

        $this->assertEquals(4, count($p), 'Deben haber 4 párrafos');

    }

}
