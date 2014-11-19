<?php

class RoleControllerTest extends TestCase {

	/**
	 * Test index route.
	 *
	 * @return void
	 */
	public function testIndex()
    {
        Role::shouldReceive('all')->once()->andReturn('foo');
        $this->call('GET', 'v1/roles');
        $this->assertRequestOk();
    }

    /**
	 * Test store route.
	 *
	 * @return void
	 */
    public function testStore()
    {
        Role::shouldReceive('save')->once()->andReturn('foo');
        $this->call('POST', 'v1/roles');
        $this->assertRequestOk();
    }

    /**
	 * Test show route.
	 *
	 * @return void
	 */
    public function testShow()
    {
        Role::shouldReceive('find')->once()->andReturn('foo');
        $this->call('GET', 'v1/roles/1');
        $this->assertRequestOk();
    }

    /**
	 * Test update route.
	 *
	 * @return void
	 */
    public function testUpdate()
    {
        Role::shouldReceive('update')->once()->andReturn('foo');
        $this->call('PUT', 'v1/roles/1');
        $this->assertRequestOk();
    }

    /**
	 * Test destroy route.
	 *
	 * @return void
	 */
    public function testDestroy()
    {
        Role::shouldReceive('delete')->once()->andReturn('foo');
        $this->call('DELETE', 'v1/roles/1');
        $this->assertRequestOk();
    }

}
