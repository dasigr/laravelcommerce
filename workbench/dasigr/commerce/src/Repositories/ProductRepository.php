<?php namespace Dasigr\Commerce\Repositories;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Dasigr\Commerce\ValidationException;
use Dasigr\Commerce\Entities\Product;

class ProductRepository {
    
    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function all()
    {
        $collection = Product::paginate();
        
        if ($collection) {
            return $collection;
        }
        
        return 'New results found.';
    }
    
    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function find($id)
    {
        $model = Product::find($id);
        
        if ($model) {
            return $model;
        }
        
        return 'Product not found.';
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function save($data)
    {
        $this->validate($data);
        
        $model = new Product();
        $model->fill($data);
        
        if ($model->save()) {
            return 'Product was saved.';
        }
        
        return 'Product was not saved.';
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id, $data)
    {
        $this->validate($data, $id);
        
        $model = $this->find($id);
        $model->fill($data);
        
        if ($model->update()) {
            return 'Product was updated.';
        }
        
        return 'Product was not updated.';
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function delete($id)
    {
        $model = $this->find($id);
        
        if ($model->delete()) {
            return 'Product was deleted.';
        }
        
        return 'Product was not deleted.';
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
            $rules['name'] = 'required|unique:product,name,'.$id;
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->fails()) {
            throw new ValidationException($validator, 401);
        }
        
        return true;
    }
}
