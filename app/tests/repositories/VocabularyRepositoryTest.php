<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class VocabularyRepositoryTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
        $this->repo = App::make('VocabularyRepository');

        Artisan::call('migrate');
        $this->seed('DatabaseSeeder');
    }

    public function testAllReturnsCollection()
    {
        $response = $this->repo->all('foo');
        $this->assertTrue($response instanceof Paginator);
    }

    public function testFindReturnsModel()
    {
        $response = $this->repo->find(1);
        $this->assertTrue($response instanceof Model);
    }

    public function testSaveReturnsModel()
    {
        $data = array(
            'name' => 'Test Vocabulary',
            'description' => 'Lorem ipsum set amet.',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $response = $this->repo->save($data);

        $this->assertTrue($response);
    }

    public function testUpdateSaves()
    {
		$data = array(
            'name' => 'Update Test Vocabulary',
            'description' => 'Lorem ipsum set amet.'
        );

        $response = $this->repo->update(1, $data);

        $this->assertTrue($response);
        // $this->assertTrue($model['data']->name === $data['name']);
    }

    public function testDeleteSaves()
    {
        $response = $this->repo->delete(1);
        $this->assertTrue($response);

        try
        {
            $this->repo->find(1);
        }
        catch (ResourceNotFoundException $e)
        {
            return;
        }

        $this->fail('ResourceNotFoundException was not raised');
    }

    public function testValidatePasses()
    {
        $data = array(
            'name' => 'Test Vocabulary',
            'description' => 'Lorem ipsum set amet.'
        );

        $response = $this->repo->validate($data);
        $this->assertTrue($response);
    }

    public function testValidateFails()
    {
        $data = array(
            'description' => 'Lorem ipsum set amet.'
        );

        try {
            $this->repo->validate($data);
        }
        catch(ValidationException $e)
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
            'name' => 'Test Vocabulary',
            'description' => 'Lorem ipsum set amet.'
        );

        $response = $this->repo->instance($data);

        $this->assertTrue($response instanceof Model);
        $this->assertTrue($response->name === $data['name']);
    }

}
