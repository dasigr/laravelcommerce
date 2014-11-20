<?php

use \UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class UserController extends \BaseController {

    public function __construct(UserRepositoryInterface $repo)
	{
		$this->repo = $repo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->repo->all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = array(
		    'status' => 'OK',
		    'message' => 'User was created',
		    'user' => $this->repo->create( Input::all() )
		);

		return Response::create($data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->repo->find($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return $this->repo->update($id, Input::all());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->repo->delete($id);
	}

}
