<?php namespace Dasigr\Core\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Dasigr\Core\Entities\User;

class UserRepository {
    
    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function all()
    {
        $collection = User::paginate();
        
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
        $model = User::find($id);
        
        if ($model) {
            return $model;
        }
        
        return 'User not found.';
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function save($data)
    {
        $model = new User();
        
        $data['password'] = Hash::make($data['password']);
        $model->fill($data);
        
        if ($model->save()) {
            return 'User was saved.';
        }
        
        return 'User was not saved.';
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id, $data)
    {
        $model = $this->find($id);
        $model->fill($data);
        
        if ($model->update()) {
            return 'User was updated.';
        }
        
        return 'User was not updated.';
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
            return 'User was deleted.';
        }
        
        return 'User was not deleted.';
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function validate($data, $id = null)
    {
        $rules = User::$rules;
        
        if ($id) {
            $rules['name'] = 'required|unique:products,name,'.$id;
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        
        return true;
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function instance($data = array())
    {
        return new User($data);
    }
    
    /**
     * Return an error message.
     * 
     * @return string
     */
    public function error()
    {
        return 'Ooops, error.';
    }
}