<?php

use PHPUnit\Framework\TestCase;

class Pruebas extends TestCase {
    protected $root = '';
    protected $archivo = '';

    const DOC_TYPE = '<!doctype html>';

    public function setUp():void{
        $this->root = str_replace('tests', '', __DIR__);
    }


    static function php_to_string($php_file, $new_GET = false, $new_POST = false) {
        // replacing $_GET, $_POST if necessary
        if($new_GET) {
            $old_GET = $_GET;
            $_GET = $new_GET;
        }
        if($new_POST) {
            $old_POST = $_POST;
            $_POST = $new_POST;
        }
        ob_start();
        include($php_file);
        // restoring $_GET, $_POST if necessary
        if(isset($old_GET)) {
            $_GET = $old_GET;
        }
        if(isset($old_POST)) {
            $_POST = $old_POST;
        }
        return ob_get_clean();
    }

}