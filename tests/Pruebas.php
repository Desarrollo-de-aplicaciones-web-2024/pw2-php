<?php

use PHPUnit\Framework\TestCase;

class Pruebas extends TestCase {
    protected $root = '';
    protected $archivo = '';

    public function setUp():void{
        $this->root = str_replace('tests', '', __DIR__);
    }

}