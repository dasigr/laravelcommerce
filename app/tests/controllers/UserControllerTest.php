<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class UserControllerTest extends TestCase
{

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
        parent::tearDown();
    }

    /**
     * Test index route.
     *
     * @return void
     */
    public function testIndex()
    {
        // Arrange
        User::shouldReceive('all')->once()->andReturn('foo');

        // Act
        $response = $this->call('GET', 'v1/users');
        $users = $response->getContent();

        // Assert
        $this->assertRequestOk();
    }

    /**
     * Test store route.
     *
     * @return void
     */
    public function testStore()
    {
        // Prepare test data
        $data = array(
            'username' => 'engineering_test_a',
            'email' => 'engineering_test_a@a5project.com',
            'password' => '*test123'
        );
        $user_model = new User($data);

        // Return a User Model
        User::shouldReceive('create')->once()->andReturn($user_model);

        // Call API
        $response = $this->call('POST', 'v1/users', $data);

        // Assert that we got a valid Response
        $this->assertInstanceOf('Illuminate\Http\Response', $response);

        // Assert that we got a valid User Model
        $user = $response->getOriginalContent()['user'];
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $user);
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
