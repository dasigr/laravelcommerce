<?php

class UserRepository implements UserRepositoryInterface {

    /**
	 * Get all of the models from the database.
	 *
	 * @param  array  $columns
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
    public function all()
    {
        $collection = User::all();

        if ($collection) {
            return $collection;
        }

        return 'No results found.';
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
        $model = User::find($id);

        if ($model) {
            return $model;
        }

        return 'User not found.';
    }

    /**
	 * Save a new model and return the instance.
	 *
	 * @param  array  $attributes
	 * @return Model
	 */
    public function create($attributes)
    {
        // Validate input data
        $this->validate($attributes);

        // Encrypt password
        $attributes['password'] = Hash::make($attributes['password']);

        // Create user
        $user = new User();
        $model = $user->create($attributes);

        // Return User Model
        return $model;
    }

    /**
	 * Update the model in the database.
	 *
	 * @param  array  $attributes
	 * @return bool|int
	 */
    public function update($id, $data)
    {
        $this->validate($data, $id);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Find user
        $user = $this->find($id);

        return $user->update($data);
    }

    /**
	 * Delete the model from the database.
	 *
	 * @return bool|null
	 * @throws \Exception
	 */
    public function delete($id)
    {
        $user = $this->find($id);

        return $user->delete();
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function validate($data, $id = null)
    {
        // Validate username's first letter is an alphabet character
        $username_array = str_split($data['username']);
        $data['username_first_char'] = $username_array[0];

        $rules = User::$rules;

        if ($id) {
            $rules['username'] = 'required|unique:users,username,'.$id;
            $rules['email'] = 'required|email|unique:users,email,'.$id;
            $rules['password'] = 'sometimes|required';
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
        return new User($data);
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
