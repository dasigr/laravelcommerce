<?php

class VocabularyControllerTest extends TestCase {

    /**
	 * Test index route.
	 *
	 * @return void
	 */
	public function testIndex()
    {
        Vocabulary::shouldReceive('all')->once()->andReturn('foo');
        $this->call('GET', 'v1/vocabularies');
        $this->assertRequestOk();
    }

    /**
	 * Test store route.
	 *
	 * @return void
	 */
    public function testStore()
    {
        Vocabulary::shouldReceive('save')->once()->andReturn('foo');
        $this->call('POST', 'v1/vocabularies');
        $this->assertRequestOk();
    }

    /**
	 * Test show route.
	 *
	 * @return void
	 */
    public function testShow()
    {
        Vocabulary::shouldReceive('find')->once()->andReturn('foo');
        $this->call('GET', 'v1/vocabularies/1');
        $this->assertRequestOk();
    }

    /**
	 * Test update route.
	 *
	 * @return void
	 */
    public function testUpdate()
    {
        Vocabulary::shouldReceive('update')->once()->andReturn('foo');
        $this->call('PUT', 'v1/vocabularies/1');
        $this->assertRequestOk();
    }

    /**
	 * Test destroy route.
	 *
	 * @return void
	 */
    public function testDestroy()
    {
        Vocabulary::shouldReceive('delete')->once()->andReturn('foo');
        $this->call('DELETE', 'v1/vocabularies/1');
        $this->assertRequestOk();
    }

}