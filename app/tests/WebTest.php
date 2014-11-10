<?php

class WebTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://laravelcommerce.local/');
    }

    public function testTitle()
    {
        $this->open('http://laravelcommerce.local/');
        sleep(10);
        $this->assertTitle('Laravel Commerce');
    }
}