<?php

class HomePageTest extends WebTestCase
{
    /**
     * Sets up the fixture.
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Tears down the fixture.
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test the homepage title
     *
     * @return void
     */
    public function testTitle()
    {
        $this->open('http://laravelcommerce.local/');
        $this->assertTitle('Laravel Commerce');
    }
}