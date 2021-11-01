<?php
require_once 'Pruebas.php';

class E13_Test extends Pruebas {

    function testExisteArchivo(){
        $this->archivo = $this->root . 'ejercicio13.php';

        $this->assertFileExists($this->archivo, 'No existe el archivo del ejercicio');
    }

    function testSolucionCorrecta(){
        $this->testExisteArchivo();

        ob_start();
        require_once $this->archivo;
        ob_get_clean();

        $this->assertTrue(isset($estados), 'Variable $estados no establecida');
        $this->assertNotEmpty($estados, 'Variable $estados sin valor');
        $this->assertIsArray($estados, 'Variable $estados no es un arreglo');
        $this->assertEquals(32, count($estados), 'La variable $estados debe contener 32 elementos');

        $str = file_get_contents( $this->archivo );
        $this->assertNotFalse( strpos($str, 'foreach'), 'Utiliza un ciclo foreach para la resolución de este ejercicio');


        $output = self::php_to_string($this->archivo);

        $str = str_ireplace(self::DOC_TYPE, '', $output);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($str);

        $this->assertIsObject($doc, 'No se pudo leer la estructura del documento, revisa que sea un documento HTML válido');

        $select = $doc->getElementsByTagName('select');
        $this->assertEquals(1, count($select), 'Debe haber 1 elemento <select>');

        $option = $doc->getElementsByTagName('option');
        $this->assertEquals(33, count($option), 'Deben haber 33 elementos <option>');

        $l_estados = array("AGS" => "Aguascalientes", "BC" => "Baja California", "BCS" => "Baja California Sur",
            "CHI" => "Chihuahua", "CHS" => "Chiapas", "CMP" => "Campeche", "COA" => "Coahuila", "COL" => "Colima",
            "DF" => "Distrito Federal", "DGO" => "Durango", "GRO" => "Guerrero", "GTO" => "Guanajuato",
            "HGO" => "Hidalgo", "JAL" => "Jalisco", "MCH" => "Michoacán", "MEX" => "Estado de México",
            "MOR" => "Morelos", "NAY" => "Nayarit", "NL" =>"Nuevo León", "OAX" => "Oaxaca", "PUE" => "Puebla",
            "QR" => "Quintana Roo", "QRO" => "Querétaro", "SIN" => "Sinaloa", "SLP" => "San Luis Potosí",
            "SON" => "Sonora", "TAB" => "Tabasco", "TLX" => "Tlaxcala", "TMS" => "Tamaulipas", "VER" => "Veracruz",
            "YUC" => "Yucatán", "ZAC" => "Zacatecas");

        $textos = 0;
        $valores = 0;

        $llaves = array_keys($l_estados);


        foreach($option as $o){
            $l_estado = trim($o->nodeValue);
            $l_value = trim($o->getAttribute('value'));

            if(in_array($l_estado, $l_estados) !== false){
                $textos++;
            }

            if(in_array($l_value, $llaves) !== false){
                $valores++;
            }
        }

        $this->assertEquals(32, $valores, 'No todos los elementos <option> cuentan con la clave del Estado correctamente');
        $this->assertEquals(32, $textos, 'No todos los elementos <option> cuentan con el nombre del Estado correctamente');

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
