<?php

class RoleRepository implements RoleRepositoryInterface {

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function all()
    {
        $collection = Role::paginate();

        if ($collection) {
            return $collection;
        }

        return 'No results found.';
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function find($id)
    {
        $model = Role::find($id);

        if ($model) {
            return $model;
        }

        return 'Role not found.';
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

        $model = new Role();
        $model->fill($data);

        if ($model->save()) {
            return 'Role was saved.';
        }

        return 'Role was not saved.';
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
            return 'Role was updated.';
        }

        return 'Role was not updated.';
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
            return 'Role was deleted.';
        }

        return 'Role was not deleted.';
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function validate($data, $id = null)
    {
        $rules = Role::$rules;

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
        return new Role($data);
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
