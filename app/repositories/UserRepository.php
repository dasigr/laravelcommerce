<?php

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
        $this->validate($data);
        $data['password'] = Hash::make($data['password']);

        $result = DB::transaction(function () use($data) {
            $user = new User();
            $user->fill($data);

            if ($user->save()) {
                $user->roles()->sync($data['roles']);
                return true;
            }
        });

        if ($result) {
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
        $this->validate($data, $id);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $result = DB::transaction(function () use($data, $id) {
            $user = $this->find($id);
            $user->fill($data);

            if ($user->save()) {
                $user->roles()->sync($data['roles']);
                return true;
            }
        });

        if ($result) {
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
            $rules['username'] = 'required|unique:users,username,'.$id;
            $rules['email'] = 'required|unique:users,email,'.$id;
            $rules['password'] = 'sometimes|required';
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator, 401);
        }

        return true;
    }
}
