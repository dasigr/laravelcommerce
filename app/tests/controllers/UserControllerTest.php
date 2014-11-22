<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserControllerTest extends TestCase
{

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();

        // Create test database schema and test data
        Artisan::call('migrate');
        $this->seed();
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    public function testUserMustBeAuthenticated()
    {
        Auth::logout();

        $response = $this->call('GET', 'v1/users');

        $this->assertEquals('Invalid credentials', $response->getContent());
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

        // Assert that we got a valid Response
        $this->assertInstanceOf('Illuminate\Http\Response', $response);

        $users = $response->getContent();
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
        $content = $response->getOriginalContent();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $content['user']);
        $this->assertEquals(200, $content['status_code']);
        $this->assertEquals('User has been created.', $content['status_text']);
    }

    /**
     * Test show route.
     *
     * @return void
     */
    public function testShow()
    {
        User::shouldReceive('find')->once()->andReturn('foo');

        $response = $this->call('GET', 'v1/users/1');

        // Assert that we got a valid Response
        $this->assertInstanceOf('Illuminate\Http\Response', $response);
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdate()
    {
        User::shouldReceive('update')->once()->andReturn('foo');

        $response = $this->call('PUT', 'v1/users/1');

        // Assert that we got a valid Response
        $this->assertInstanceOf('Illuminate\Http\Response', $response);
    }

    /**
     * Test destroy route.
     *
     * @return void
     */
    public function testDestroy()
    {
        User::shouldReceive('delete')->once()->andReturn('foo');

        $response = $this->call('DELETE', 'v1/users/1');

        // Assert that we got a valid Response
        $this->assertInstanceOf('Illuminate\Http\Response', $response);
    }
}
