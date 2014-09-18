<?php

use \ProductRepositoryInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Description of ProductRepository
 *
 * @author Kyle
 */
class ProductRepository implements ProductRepositoryInterface {

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Collection
	 */
    public function all()
    {
        $collection = Product::paginate();

        if ($collection) {
            return $collection;
        }

        throw new Exception('Something went wrong!', 500);
    }

    /**
	 * Find a model by its primary key.
	 *
	 * @param  mixed  $id
	 * @param  array  $columns
	 * @return \Illuminate\Support\Collection|static
	 */
    public function find($id)
    {
        $model = Product::find($id);

        if ($model) {
            return $model;
        }

        throw new ResourceNotFoundException('Product was not found.');
    }

    /**
	 * Save the model to the database.
	 *
	 * @param  array  $data
	 * @return bool
	 */
    public function save($data)
    {
        $this->validate($data);

        $model = $this->instance();
        $model->fill($data);

        return $model->save();
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return bool
	 */
    public function update($id, $data)
    {
        $this->validate($data, $id);

        $model = $this->find($id);
        $model->fill($data);

        return $model->update();
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return bool
	 */
    public function delete($id)
    {
        $model = $this->find($id);
        return $model->delete();
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function validate($data, $id = null)
    {
        $rules = Product::$rules;

        if ($id) {
            $rules['name'] = 'required|unique:role,name,'.$id;
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator, 401);
        }

        return true;
    }

    /**
	 * Create an instance.
	 *
	 * @param array $data
	 * @return Model
	 */
    public function instance($data = array())
    {
        return new Product($data);
    }

    /**
     * Throw an Exception error
     *
     * @throws Exception
     */
    public function error()
    {
        throw new Exception('Something went wrong!');
    }

}
