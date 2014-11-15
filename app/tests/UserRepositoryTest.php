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
     * testStoreReturnsModel()
     * 
     * @return void
     */
    public function testStoreReturnsModel()
    {
        // Prepare user attributes
        $attributes = array(
            'username'                  => 'engineering_test1',
            'email'                 => 'engineering_test1@a5project.com',
            'password'              => '*test123'
        );
        
        // Create user and get user model.
        $model = $this->repo->create($attributes);
        
        // Assert
        $this->assertTrue($model instanceof Model);
        $this->assertTrue($model->username === $attributes['username']);
    }
    
    public function testFindAllReturnsCollection()
    {
        $response = $this->repo->all('foo');
        $this->assertTrue($response instanceof Paginator);
    }
    
    public function testFindByIdReturnsModel()
    {
        $response = $this->repo->find(1);
        $this->assertTrue($response instanceof Model);
    }
    
    public function testUpdateSaves()
    {
        $data = array(
            'name'  => 'user',
            'email' => 'user@example.com'
        );
        
        $model = $this->repo->update(1, $data);
        
        /**
         * TO DO: Fix error on missing roles column.
         */
        
        $this->assertTrue($model instanceof Model);
        $this->assertTrue($model->name === $data['name']);
    }
    
    public function testDestroySaves()
    {
        $model = $this->repo->delete(1);
        $this->assertTrue($model instanceof Model);
        
        try
        {
            $this->repo->find(1);
        }
        catch (NotFoundException $e)
        {
            return;
        }

        // $this->fail('NotFoundException was not raised');
    }
    
    public function testValidatePasses()
    {
        $data = array(
            'name'                  => 'user',
            'email'                 => 'user@example.com',
            'password'              => 'user',
            'password_confirmation' => 'user',
            'roles'                 => '2'
        );
        
        $response = $this->repo->validate($data);
        $this->assertTrue($response);
    }
    
    public function testValidateFails()
    {
        $data = array(
            'name'                  => 'user',
            'password'              => 'user',
            // 'password_confirmation' => 'user',
            'roles'                 => '2'
        );
        
        try {
            $this->repo->validate($data);
        }
        catch(ValidationException $expected)
        {
            return;
        }

        $this->fail('ValidationException was not raised');
    }
    
    public function testInstanceReturnsModel()
    {
        $response = $this->repo->instance();
        $this->assertTrue($response instanceof Model);
    }

    public function testInstanceReturnsModelWithData()
    {
        $data = array(
            'name'                  => 'user',
            'email'                 => 'user@example.com',
            'password'              => 'user',
            // 'password_confirmation' => 'user',
            'roles'                 => '2'
        );

        $response = $this->repo->instance($data);
        
        $this->assertTrue($response instanceof Model);
        $this->assertTrue($response->name === $data['name']);
    }
    
}
