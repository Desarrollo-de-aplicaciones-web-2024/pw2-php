<?php
require_once 'Pruebas.php';

class E15_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio15.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta()
    {
        setlocale(LC_TIME, 'es');

        $this->testExisteArchivo();


        $fechas = array('Y-m-d', 'Y-01-01', 'Y-12-31');

        foreach($fechas as $fecha) {
            $output = self::php_to_string($this->archivo, array('fecha_a_formatear' => date($fecha)));

            $str = str_ireplace(self::DOC_TYPE, '', $output);

            $doc = new DOMDocument();

            libxml_use_internal_errors(true);
            $doc->loadHTML($str);

            $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

            $ul = $doc->getElementsByTagName('ul');
            $this->assertEquals(1, count($ul), 'Debe haber 1 elemento <ul>');

            $li = $doc->getElementsByTagName('li');
            $this->assertEquals(4, count($li), 'Deben haber 4 elementos <li>');


            $milisegundos = strtotime(date($fecha));

            $fecha1 = strftime('%e de %B de %Y', $milisegundos);
            $dia = strftime('%j', $milisegundos);

            $dia_semana = strftime('%A', $milisegundos);
            $semana = strftime('%W', $milisegundos);

            $this->assertEquals("La fecha $fecha1", $li[0]->nodeValue, 'El texto del primer elemento <li> es incorrecto (' . date($fecha) . ')');
            $this->assertEquals("siendo el día $dia", $li[1]->nodeValue, 'El texto del segundo elemento <li> es incorrecto (' . date($fecha) . ')');
            $this->assertEquals("cayó en $dia_semana", $li[2]->nodeValue, 'El texto del tercer elemento <li> es incorrecto (' . date($fecha) . ')');
            $this->assertStringContainsStringIgnoringCase("de la semana $semana del a", $li[3]->nodeValue, 'El texto del cuarto elemento <li> es incorrecto (' . date($fecha) . ')');
        }

    }

    static function strpos_all($haystack, $needle) {
        $offset = 0;
        $allpos = array();
        while (($pos = strpos($haystack, $needle, $offset)) !== FALSE) {
            $offset   = $pos + 1;
            $allpos[] = $pos;
        }
        return $allpos;
    }

}
