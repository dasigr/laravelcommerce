<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductControllerTest
 *
 * @author Kyle
 */
class ProductControllerTest extends TestCase {

    /**
	 * Setup the test environment.
	 *
	 * @return void
	 */
    public function setUp()
    {
        parent::setUp();

        $this->mock = Mockery::mock('ProductRepositoryInterface');
        App::instance('ProductRepositoryInterface', $this->mock);
    }

    /**
	 * Test index route.
	 *
	 * @return void
	 */
	public function testIndex()
    {
        $this->mock->shouldReceive('all')->once()->andReturn('foo');
        $this->call('GET', 'v1/products');
        $this->assertRequestOk();
    }

    /**
	 * Test store route.
	 *
	 * @return void
	 */
    public function testStore()
    {
        $this->mock->shouldReceive('save')->once()->andReturn('foo');
        $this->call('POST', 'v1/products');
        $this->assertRequestOk();
    }

    /**
	 * Test show route.
	 *
	 * @return void
	 */
    public function testShow()
    {
        $this->mock->shouldReceive('find')->once()->andReturn('foo');
        $this->call('GET', 'v1/products/1');
        $this->assertRequestOk();
    }

    /**
	 * Test update route.
	 *
	 * @return void
	 */
    public function testUpdate()
    {
        $this->mock->shouldReceive('update')->once()->andReturn('foo');
        $this->call('PUT', 'v1/products/1');
        $this->assertRequestOk();
    }

    /**
	 * Test destroy route.
	 *
	 * @return void
	 */
    public function testDestroy()
    {
        $this->mock->shouldReceive('delete')->once()->andReturn('foo');
        $this->call('DELETE', 'v1/products/1');
        $this->assertRequestOk();
    }

}
