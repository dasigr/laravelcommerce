<?php

class UserControllerTest extends TestCase
{

    /**
     * Test index route.
     *
     * @return void
     */
    public function testIndex()
    {
        User::shouldReceive('all')->once()->andReturn('foo');

        $this->call('GET', 'v1/users');

        $this->assertRequestOk();
    }

    /**
     * Test store route.
     *
     * @return void
     */
    public function testStore()
    {
        User::shouldReceive('save')->once()->andReturn('foo');

        $this->call('POST', 'v1/users');

        $this->assertRequestOk();
    }

    /**
     * Test show route.
     *
     * @return void
     */
    public function testShow()
    {
        User::shouldReceive('find')->once()->andReturn('foo');

        $this->call('GET', 'v1/users/1');

        $this->assertRequestOk();
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdate()
    {
        User::shouldReceive('update')->once()->andReturn('foo');

        $this->call('PUT', 'v1/users/1');

        $this->assertRequestOk();
    }

    /**
     * Test destroy route.
     *
     * @return void
     */
    public function testDestroy()
    {
        User::shouldReceive('delete')->once()->andReturn('foo');

        $this->call('DELETE', 'v1/users/1');

        $this->assertRequestOk();
    }
}
