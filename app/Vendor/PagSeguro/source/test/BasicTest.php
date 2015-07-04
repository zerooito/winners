<?php

class BasicTest extends PHPUnit_Framework_TestCase
{

    public function testDependencies()
    {
        $this->assertInstanceOf('PagSeguroLibrary', PagSeguroLibrary::init());
    }
}
