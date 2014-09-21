<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
	 * Setup the test environment.
	 *
	 * @return void
	 */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Teardown objects.
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
