<?php

class WebTestCase extends PHPUnit_Extensions_SeleniumTestCase
{
    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://laravelcommerce.local/');
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
