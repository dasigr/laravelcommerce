<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class UserRepositoryTest extends TestCase {

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();

        $this->repo = App::make('UserRepository');

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

    /**
     * testValidateUsernameFails()
     *
     * @expectedException ValidationException
     * @return void
     */
    public function testValidateUsernameFails()
    {
        // Prepare user attributes
        $attributes = array(
            'username'  => 'engineering_&^%$#@!',
            'email'     => 'engineering_test1@a5project.com',
            'password'  => '*test123'
        );

        // Create user
        $model = $this->repo->create($attributes);
    }

    /**
     * testValidateUsernameFirstCharFails()
     *
     * @expectedException ValidationException
     * @return void
     */
    public function testValidateUsernameFirstCharFails()
    {
        // Prepare user attributes
        $attributes = array(
            'username'  => '1engineering_test',
            'email'     => 'engineering_test1@a5project.com',
            'password'  => '*test123'
        );

        // Create user
        $model = $this->repo->create($attributes);
    }

    /**
     * testValidateEmailFails()
     *
     * @expectedException ValidationException
     * @return void
     */
    public function testValidateEmailFails()
    {
        // Prepare user attributes
        $attributes = array(
            'username'  => 'engineering_test1',
            'email'     => 'dsfdsf sfs.com',
            'password'  => '*test123'
        );

        // Create user
        $this->repo->create($attributes);
    }

    /**
     * testValidateEmailFails()
     *
     * @expectedException ValidationException
     * @return void
     */
    public function testValidatePasswordFails()
    {
        // Prepare user attributes
        $attributes = array(
            'username'  => 'engineering_test1',
            'email'     => 'engineering_test1@a5project.com',
            'password'  => ''
        );

        // Create user
        $this->repo->create($attributes);
    }

    /**
     * testValidatePasses()
     *
     * @return void
     */
    public function testValidatePasses()
    {
        // Prepare user attributes
        $attributes = array(
            'username'  => 'engineering_test_a',
            'email'     => 'engineering_test_a@a5project.com',
            'password'  => '*test123'
        );

        // Create user
        $model = $this->repo->create($attributes);
    }

    /**
     * testCreateUser()
     *
     * @return void
     */
    public function testCreateUser()
    {
        // Prepare user attributes
        $attributes = array(
            'username'  => 'engineering_test_a',
            'email'     => 'engineering_test_a@a5project.com',
            'password'  => '*test123'
        );

        // Create user and get user model.
        $user = $this->repo->create($attributes);

        // Assert
        $this->assertTrue($user instanceof Model);
        $this->assertEquals($attributes['username'], $user->username);
    }

    /**
     * testFindUser()
     *
     * @return void
     */
    public function testFindUser()
    {
        $user = $this->repo->find(2);

        $this->assertTrue($user instanceof Model);
        $this->assertEquals('engineering_test1', $user->username);
        $this->assertEquals('engineering_test1@a5project.com', $user->email);
    }

    /**
     * testUpdateUser()
     *
     * @return void
     */
    public function testUpdateUser()
    {
        // Prepare user attributes
        $attributes = array(
            'username'  => 'engineering_test1_updated',
            'email'     => 'engineering_test1_updated@a5project.com'
        );

        $is_udpated = $this->repo->update(2, $attributes);
        $this->assertTrue($is_udpated);

        $user = $this->repo->find(2);
        $this->assertEquals($attributes['username'], $user->username);
        $this->assertEquals($attributes['email'], $user->email);
    }

    /**
     * testDeleteUser()
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @return void
     */
    public function testDeleteUser()
    {
        $is_deleted = $this->repo->delete(2);
        $this->assertTrue($is_deleted);

        $user = $this->repo->find(2);
    }

    /**
     * testAllUsers()
     *
     * @return void
     */
    public function testAllUsers()
    {
        $users = $this->repo->all();
        $this->assertTrue($users instanceof Collection);
    }

    /**
     * testInstanceReturnsModel()
     *
     * @return void
     */
    public function testInstanceReturnsModel()
    {
        $user = $this->repo->instance();
        $this->assertTrue($user instanceof Model);
    }

    /**
     * testInstanceReturnsModelWithData()
     *
     * @return void
     */
    public function testInstanceReturnsModelWithData()
    {
        $attributes = array(
            'username'  => 'engineering_test2',
            'email'     => 'engineering_test2@a5project.com',
            'password'  => '*test123',
        );

        $user = $this->repo->instance($attributes);

        $this->assertTrue($user instanceof Model);
        $this->assertEquals($user->username, $attributes['username']);
    }
}
