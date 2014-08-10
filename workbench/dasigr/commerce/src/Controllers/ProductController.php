<?php namespace Dasigr\Commerce\Controllers;

use Illuminate\Support\Facades\Input;
use Dasigr\Commerce\Repositories\ProductRepository;
use Illuminate\Support\Facades\Log;

class ProductController extends \BaseController {
    
    public function __construct(ProductRepository $repo)
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
		return $this->repo->save(Input::all());
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
