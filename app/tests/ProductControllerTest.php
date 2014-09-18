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
	 * Test index route.
	 *
	 * @return void
	 */
	public function testIndex()
    {
        Product::shouldReceive('all')->once()->andReturn('foo');
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
        Product::shouldReceive('save')->once()->andReturn('foo');
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
        Product::shouldReceive('find')->once()->andReturn('foo');
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
        Product::shouldReceive('update')->once()->andReturn('foo');
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
        Product::shouldReceive('delete')->once()->andReturn('foo');
        $this->call('DELETE', 'v1/products/1');
        $this->assertRequestOk();
    }

}
