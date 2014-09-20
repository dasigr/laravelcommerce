<?php

class TermControllerTest extends TestCase {

    /**
	 * Test index route.
	 *
	 * @return void
	 */
	public function testIndex()
    {
        Term::shouldReceive('all')->once()->andReturn('foo');
        $this->call('GET', 'v1/terms');
        $this->assertRequestOk();
    }

    /**
	 * Test store route.
	 *
	 * @return void
	 */
    public function testStore()
    {
        Term::shouldReceive('save')->once()->andReturn('foo');
        $this->call('POST', 'v1/terms');
        $this->assertRequestOk();
    }

    /**
	 * Test show route.
	 *
	 * @return void
	 */
    public function testShow()
    {
        Term::shouldReceive('find')->once()->andReturn('foo');
        $this->call('GET', 'v1/terms/1');
        $this->assertRequestOk();
    }

    /**
	 * Test update route.
	 *
	 * @return void
	 */
    public function testUpdate()
    {
        Term::shouldReceive('update')->once()->andReturn('foo');
        $this->call('PUT', 'v1/terms/1');
        $this->assertRequestOk();
    }

    /**
	 * Test destroy route.
	 *
	 * @return void
	 */
    public function testDestroy()
    {
        Term::shouldReceive('delete')->once()->andReturn('foo');
        $this->call('DELETE', 'v1/terms/1');
        $this->assertRequestOk();
    }

}