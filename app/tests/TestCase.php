<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    public function tearDown()
    {
        Mockery::close();
    }

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

    /**
     * Assert if Response is Ok
     */
    public function assertRequestOk()
    {
        $this->assertTrue($this->client->getResponse()->isOk());
    }

}
